<?php
// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Páginas Públicas
    public function index(Request $request)
    {
        $query = Post::published()->with(['user', 'category']);
        
        // Filtro por categoria
        if ($request->has('category') && $request->category) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
        
        // Filtro por autor
        if ($request->has('author') && $request->author) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('id', $request->author);
            });
        }
        
        $posts = $query->orderBy('published_at', 'desc')
            ->paginate(10);
            
        $categories = Category::withCount('posts')->get();
        $popularAuthors = User::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->take(5)
            ->get();
            
        return view('posts.index', compact('posts', 'categories', 'popularAuthors'));
    }
    
    public function show($slug)
    {
        $post = Post::where('slug', $slug)
            ->with(['user', 'category', 'comments' => function($query) {
                $query->approved()->orderBy('created_at', 'desc');
            }])
            ->firstOrFail();
            
        // Incrementar visualizações
        $post->increment('views');
        
        $relatedPosts = Post::published()
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->take(3)
            ->get();
            
        return view('posts.show', compact('post', 'relatedPosts'));
    }
    
    public function byCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        
        $posts = Post::published()
            ->where('category_id', $category->id)
            ->with(['user', 'category'])
            ->orderBy('published_at', 'desc')
            ->paginate(10);
            
        return view('posts.category', compact('category', 'posts'));
    }
    
    public function byAuthor($id)
    {
        $author = User::findOrFail($id);
        
        $posts = Post::published()
            ->where('user_id', $author->id)
            ->with(['user', 'category'])
            ->orderBy('published_at', 'desc')
            ->paginate(10);
            
        return view('posts.author', compact('author', 'posts'));
    }
    
    // Painel Administrativo
    public function adminIndex(Request $request)
    {
        $query = Post::with(['user', 'category']);
        
        // Filtrar por autor se não for admin
        if (!auth()->user()->isAdmin()) {
            $query->where('user_id', auth()->id());
        }
        
        // Busca
        if ($request->has('search') && $request->search) {
            $query->search($request->search);
        }
        
        $posts = $query->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.posts.index', compact('posts'));
    }
    
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'excerpt' => 'required',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',
        ]);
        
        $post = new Post($validated);
        $post->user_id = auth()->id();
        
        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('posts', 'public');
        }
        
        $post->save();
        
        return redirect()->route('admin.posts.index')
            ->with('success', 'Post criado com sucesso!');
    }
    
    public function edit(Post $post)
    {
        // Verificar permissão
        if (!auth()->user()->isAdmin() && auth()->id() !== $post->user_id) {
            abort(403);
        }
        
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }
    
    public function update(Request $request, Post $post)
    {
        // Verificar permissão
        if (!auth()->user()->isAdmin() && auth()->id() !== $post->user_id) {
            abort(403);
        }
        
        $validated = $request->validate([
            'title' => 'required|max:255',
            'excerpt' => 'required',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',
        ]);
        
        if ($request->hasFile('image')) {
            // Deletar imagem antiga
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }
        
        $post->update($validated);
        
        return redirect()->route('admin.posts.index')
            ->with('success', 'Post atualizado com sucesso!');
    }
    
    public function destroy(Post $post)
    {
        // Verificar permissão
        if (!auth()->user()->isAdmin() && auth()->id() !== $post->user_id) {
            abort(403);
        }
        
        // Deletar imagem
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        
        $post->delete();
        
        return redirect()->route('admin.posts.index')
            ->with('success', 'Post excluído com sucesso!');
    }
}