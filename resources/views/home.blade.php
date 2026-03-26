{{-- resources/views/home.blade.php --}}
@extends('layouts.public')

@section('title', 'Home - MTec')

@section('content')
<style>
    .hero {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: var(--white);
        padding: 4rem 2rem;
        border-radius: var(--border-radius);
        text-align: center;
        margin-bottom: 3rem;
    }
    
    .hero h1 {
        font-size: 3rem;
        margin-bottom: 1rem;
    }
    
    .hero p {
        font-size: 1.2rem;
        opacity: 0.9;
    }
    
    .posts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }
    
    .post-card {
        background: var(--white);
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: transform 0.3s, box-shadow 0.3s;
    }
    
    .post-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }
    
    .post-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    
    .post-content {
        padding: 1.5rem;
    }
    
    .post-category {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        background: var(--primary-color);
        color: var(--white);
        border-radius: 20px;
        font-size: 0.8rem;
        margin-bottom: 0.75rem;
        text-decoration: none;
    }
    
    .post-title {
        font-size: 1.25rem;
        margin-bottom: 0.75rem;
    }
    
    .post-title a {
        color: var(--text-dark);
        text-decoration: none;
        transition: color 0.3s;
    }
    
    .post-title a:hover {
        color: var(--primary-color);
    }
    
    .post-excerpt {
        color: var(--text-light);
        margin-bottom: 1rem;
        line-height: 1.5;
    }
    
    .post-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.85rem;
        color: var(--text-light);
    }
    
    .post-author {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .author-avatar-small {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        object-fit: cover;
    }
    
    .section-title {
        font-size: 2rem;
        margin-bottom: 2rem;
        text-align: center;
    }
    
    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 3rem;
    }
    
    .category-card {
        background: var(--white);
        padding: 1.5rem;
        text-align: center;
        border-radius: var(--border-radius);
        text-decoration: none;
        transition: transform 0.3s;
    }
    
    .category-card:hover {
        transform: translateY(-3px);
    }
    
    .category-name {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }
    
    .category-count {
        color: var(--text-light);
        font-size: 0.9rem;
    }
    
    @media (max-width: 768px) {
        .hero h1 {
            font-size: 2rem;
        }
        
        .posts-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="hero">
    <h1>Bem-vindo ao MTec</h1>
    <p>Seu portal de tecnologia com os melhores conteúdos sobre programação e inovação</p>
</div>

<!-- Últimos Posts -->
<h2 class="section-title">Últimos Posts</h2>
<div class="posts-grid">
    @forelse($latestPosts as $post)
        <article class="post-card">
            @if($post->image)
                <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="post-image">
            @endif
            <div class="post-content">
                <a href="{{ route('categories.posts', $post->category->slug) }}" class="post-category">
                    {{ $post->category->name }}
                </a>
                <h3 class="post-title">
                    <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                </h3>
                <p class="post-excerpt">{{ $post->excerpt_html }}</p>
                <div class="post-meta">
                    <div class="post-author">
                        <img src="{{ $post->user->avatar_url }}" alt="{{ $post->user->name }}" class="author-avatar-small">
                        <span>{{ $post->user->name }}</span>
                    </div>
                    <span>{{ $post->published_at_date }}</span>
                </div>
            </div>
        </article>
    @empty
        <p>Nenhum post encontrado.</p>
    @endforelse
</div>

<!-- Categorias em Destaque -->
<h2 class="section-title">Categorias em Destaque</h2>
<div class="categories-grid">
    @foreach($featuredCategories as $category)
        <a href="{{ route('categories.posts', $category->slug) }}" class="category-card">
            <div class="category-name">{{ $category->name }}</div>
            <div class="category-count">{{ $category->posts_count }} posts</div>
        </a>
    @endforeach
</div>
@endsection