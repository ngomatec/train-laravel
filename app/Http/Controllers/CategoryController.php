<?php
// app/Http/Controllers/CategoryController.php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Páginas Públicas
    public function index()
    {
        $categories = Category::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->paginate(12);
            
        return view('categories.index', compact('categories'));
    }
    
    // Painel Administrativo
    public function adminIndex()
    {
        $categories = Category::withCount('posts')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.categories.index', compact('categories'));
    }
    
    public function create()
    {
        return view('admin.categories.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:100',
            'description' => 'nullable|max:500',
        ]);
        
        Category::create($validated);
        
        return redirect()->route('admin.categories.index')
            ->with('success', 'Categoria criada com sucesso!');
    }
    
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }
    
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id . '|max:100',
            'description' => 'nullable|max:500',
        ]);
        
        $category->update($validated);
        
        return redirect()->route('admin.categories.index')
            ->with('success', 'Categoria atualizada com sucesso!');
    }
    
    public function destroy(Category $category)
    {
        // Verificar se a categoria tem posts
        if ($category->posts()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Não é possível excluir uma categoria que possui posts!');
        }
        
        $category->delete();
        
        return redirect()->route('admin.categories.index')
            ->with('success', 'Categoria excluída com sucesso!');
    }
}