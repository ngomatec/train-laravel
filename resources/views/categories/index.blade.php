{{-- resources/views/categories/index.blade.php --}}
@extends('layouts.public')

@section('title', 'Categorias - MTec')

@section('content')
<style>
    .categories-header {
        text-align: center;
        margin-bottom: 3rem;
    }
    
    .categories-header h1 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }
    
    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
    }
    
    .category-card-large {
        background: var(--white);
        padding: 2rem;
        border-radius: var(--border-radius);
        text-align: center;
        text-decoration: none;
        transition: all 0.3s;
        box-shadow: var(--shadow);
    }
    
    .category-card-large:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }
    
    .category-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }
    
    .category-name-large {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }
    
    .category-description {
        color: var(--text-light);
        margin-bottom: 1rem;
        line-height: 1.5;
    }
    
    .category-stats {
        display: inline-block;
        padding: 0.5rem 1rem;
        background: var(--primary-color);
        color: var(--white);
        border-radius: var(--border-radius);
        font-size: 0.9rem;
    }
</style>

<div class="categories-header">
    <h1>Categorias</h1>
    <p>Explore nossos artigos por categoria</p>
</div>

<div class="categories-grid">
    @forelse($categories as $category)
        <a href="{{ route('categories.posts', $category->slug) }}" class="category-card-large">
            <div class="category-icon">
                @switch($category->name)
                    @case('PHP') 🐘 @break
                    @case('JavaScript') 📜 @break
                    @case('DevOps') 🚀 @break
                    @case('Banco de Dados') 🗄️ @break
                    @case('Segurança') 🔒 @break
                    @default 📚
                @endswitch
            </div>
            <div class="category-name-large">{{ $category->name }}</div>
            @if($category->description)
                <div class="category-description">{{ $category->description }}</div>
            @endif
            <div class="category-stats">{{ $category->posts_count }} posts</div>
        </a>
    @empty
        <p>Nenhuma categoria encontrada.</p>
    @endforelse
</div>

<div class="pagination" style="margin-top: 3rem;">
    {{ $categories->links() }}
</div>
@endsection