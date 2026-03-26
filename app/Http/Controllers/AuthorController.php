<?php
// app/Http/Controllers/AuthorController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    // Páginas Públicas
    public function index()
    {
        $authors = User::authors()
            ->withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->paginate(12);
            
        return view('authors.index', compact('authors'));
    }
    
    public function show($id)
    {
        $author = User::with(['posts' => function($query) {
                $query->published()->orderBy('published_at', 'desc')->take(5);
            }])
            ->findOrFail($id);
            
        $totalPosts = $author->posts()->published()->count();
        
        return view('authors.show', compact('author', 'totalPosts'));
    }
    
    // Painel Administrativo
    public function adminIndex()
    {
        $users = User::withCount('posts')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.users.index', compact('users'));
    }
    
    public function create()
    {
        return view('admin.users.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:admin,author',
            'bio' => 'nullable|max:500',
            'avatar' => 'nullable|image|max:2048',
        ]);
        
        $validated['password'] = bcrypt($validated['password']);
        
        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }
        
        User::create($validated);
        
        return redirect()->route('admin.users.index')
            ->with('success', 'Usuário criado com sucesso!');
    }
    
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }
    
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,author',
            'bio' => 'nullable|max:500',
            'avatar' => 'nullable|image|max:2048',
            'password' => 'nullable|min:6|confirmed',
        ]);
        
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }
        
        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }
        
        $user->update($validated);
        
        return redirect()->route('admin.users.index')
            ->with('success', 'Usuário atualizado com sucesso!');
    }
    
    public function destroy(User $user)
    {
        // Não permitir excluir o próprio usuário
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Você não pode excluir seu próprio usuário!');
        }
        
        // Verificar se o usuário tem posts
        if ($user->posts()->count() > 0) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Não é possível excluir um usuário que possui posts!');
        }
        
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }
        
        $user->delete();
        
        return redirect()->route('admin.users.index')
            ->with('success', 'Usuário excluído com sucesso!');
    }
}