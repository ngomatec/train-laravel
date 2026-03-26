{{-- resources/views/authors/index.blade.php --}}
@extends('layouts.public')

@section('title', 'Autores - MTec')

@section('content')
<style>
    .authors-header {
        text-align: center;
        margin-bottom: 3rem;
    }
    
    .authors-header h1 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }
    
    .authors-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
    }
    
    .author-card {
        background: var(--white);
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--shadow);
        text-align: center;
        transition: transform 0.3s;
    }
    
    .author-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }
    
    .author-cover {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        padding: 2rem;
        position: relative;
    }
    
    .author-avatar-large {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 4px solid var(--white);
        object-fit: cover;
    }
    
    .author-info {
        padding: 1.5rem;
    }
    
    .author-name {
        font-size: 1.3rem;
        margin-bottom: 0.5rem;
        color: var(--text-dark);
    }
    
    .author-role {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        background: var(--gray-light);
        border-radius: 20px;
        font-size: 0.8rem;
        margin-bottom: 1rem;
    }
    
    .author-bio {
        color: var(--text-light);
        margin-bottom: 1rem;
        line-height: 1.5;
    }
    
    .author-stats {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }
    
    .stat {
        text-align: center;
    }
    
    .stat-number {
        font-size: 1.2rem;
        font-weight: bold;
        color: var(--primary-color);
    }
    
    .stat-label {
        font-size: 0.8rem;
        color: var(--text-light);
    }
    
    .view-posts-btn {
        display: inline-block;
        padding: 0.5rem 1rem;
        background: var(--primary-color);
        color: var(--white);
        text-decoration: none;
        border-radius: var(--border-radius);
        transition: background 0.3s;
    }
    
    .view-posts-btn:hover {
        background: var(--primary-dark);
    }
</style>

<div class="authors-header">
    <h1>Nossos Autores</h1>
    <p>Conheça os profissionais que compartilham conhecimento no MTec</p>
</div>

<div class="authors-grid">
    @forelse($authors as $author)
        <div class="author-card">
            <div class="author-cover">
                <img src="{{ $author->avatar_url }}" alt="{{ $author->name }}" class="author-avatar-large">
            </div>
            <div class="author-info">
                <h2 class="author-name">{{ $author->name }}</h2>
                <div class="author-role">{{ $author->role_label }}</div>
                @if($author->bio)
                    <div class="author-bio">{{ Str::limit($author->bio, 100) }}</div>
                @endif
                <div class="author-stats">
                    <div class="stat">
                        <div class="stat-number">{{ $author->posts_count }}</div>
                        <div class="stat-label">Posts</div>
                    </div>
                </div>
                <a href="{{ route('authors.posts', $author->id) }}" class="view-posts-btn">
                    Ver Posts
                </a>
            </div>
        </div>
    @empty
        <p>Nenhum autor encontrado.</p>
    @endforelse
</div>

<div class="pagination" style="margin-top: 3rem;">
    {{ $authors->links() }}
</div>
@endsection