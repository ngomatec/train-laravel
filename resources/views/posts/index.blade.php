{{-- resources/views/posts/index.blade.php --}}
@extends('layouts.public')

@section('title', 'Posts - MTec')

@section('content')
<style>
    .posts-header {
        margin-bottom: 2rem;
        text-align: center;
    }
    
    .posts-header h1 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }
    
    .filters {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
        margin-bottom: 2rem;
    }
    
    .filter-btn {
        padding: 0.5rem 1rem;
        background: var(--white);
        border: 1px solid var(--gray);
        border-radius: var(--border-radius);
        text-decoration: none;
        color: var(--text-dark);
        transition: all 0.3s;
    }
    
    .filter-btn.active,
    .filter-btn:hover {
        background: var(--primary-color);
        color: var(--white);
        border-color: var(--primary-color);
    }
    
    .posts-layout {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }
    
    .posts-list {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }
    
    .post-item {
        background: var(--white);
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--shadow);
        display: flex;
        gap: 1.5rem;
        transition: transform 0.3s;
    }
    
    .post-item:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-lg);
    }
    
    .post-item-image {
        width: 250px;
        height: 200px;
        object-fit: cover;
    }
    
    .post-item-content {
        flex: 1;
        padding: 1.5rem 1.5rem 1.5rem 0;
    }
    
    .pagination {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 2rem;
    }
    
    .pagination a,
    .pagination span {
        padding: 0.5rem 1rem;
        background: var(--white);
        border-radius: var(--border-radius);
        text-decoration: none;
        color: var(--text-dark);
        transition: all 0.3s;
    }
    
    .pagination a:hover {
        background: var(--primary-color);
        color: var(--white);
    }
    
    .pagination .active span {
        background: var(--primary-color);
        color: var(--white);
    }
    
    @media (max-width: 768px) {
        .posts-layout {
            grid-template-columns: 1fr;
        }
        
        .post-item {
            flex-direction: column;
        }
        
        .post-item-image {
            width: 100%;
            height: 200px;
        }
        
        .post-item-content {
            padding: 1.5rem;
        }
    }
</style>

<div class="posts-header">
    <h1>Todos os Posts</h1>
    <p>Explore nossos artigos sobre tecnologia e programação</p>
</div>

<div class="posts-layout">
    <div class="posts-list">
        @forelse($posts as $post)
            <article class="post-item">
                @if($post->image)
                    <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="post-item-image">
                @endif
                <div class="post-item-content">
                    <a href="{{ route('categories.posts', $post->category->slug) }}" class="post-category">
                        {{ $post->category->name }}
                    </a>
                    <h2 class="post-title">
                        <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                    </h2>
                    <p class="post-excerpt">{{ $post->excerpt_html }}</p>
                    <div class="post-meta">
                        <div class="post-author">
                            <img src="{{ $post->user->avatar_url }}" alt="{{ $post->user->name }}" class="author-avatar-small">
                            <span>{{ $post->user->name }}</span>
                        </div>
                        <span>{{ $post->published_at_date }}</span>
                        <span>{{ $post->reading_time }}</span>
                    </div>
                </div>
            </article>
        @empty
            <p>Nenhum post encontrado.</p>
        @endforelse
        
        <div class="pagination">
            {{ $posts->links() }}
        </div>
    </div>
    
    @include('partials.sidebar', ['categories' => $categories, 'popularAuthors' => $popularAuthors])
</div>
@endsection