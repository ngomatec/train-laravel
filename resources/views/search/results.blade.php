{{-- resources/views/search/results.blade.php --}}
@extends('layouts.public')

@section('title', "Resultados para: {$query} - MTec")

@section('content')
<style>
    .search-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .search-header h1 {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }
    
    .search-query {
        color: var(--primary-color);
    }
    
    .search-stats {
        color: var(--text-light);
        margin-bottom: 2rem;
    }
    
    .no-results {
        text-align: center;
        padding: 3rem;
        background: var(--white);
        border-radius: var(--border-radius);
    }
    
    .no-results h3 {
        margin-bottom: 1rem;
    }
    
    .search-suggestions {
        margin-top: 1rem;
        color: var(--text-light);
    }
</style>

<div class="search-header">
    <h1>Resultados da busca por: <span class="search-query">"{{ $query }}"</span></h1>
    <div class="search-stats">{{ $posts->total() }} resultados encontrados</div>
</div>

@if($posts->count() > 0)
    <div class="posts-list">
        @foreach($posts as $post)
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
        @endforeach
        
        <div class="pagination">
            {{ $posts->appends(['q' => $query])->links() }}
        </div>
    </div>
@else
    <div class="no-results">
        <h3>Nenhum resultado encontrado para "{{ $query }}"</h3>
        <p>Tente buscar por outros termos ou navegue pelas categorias.</p>
        <div class="search-suggestions">
            <p>Sugestões:</p>
            <ul>
                <li>Verifique a ortografia dos termos</li>
                <li>Tente usar palavras mais genéricas</li>
                <li>Navegue pelas categorias para encontrar conteúdos relacionados</li>
            </ul>
        </div>
    </div>
@endif
@endsection