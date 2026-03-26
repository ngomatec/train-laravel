{{-- resources/views/posts/show.blade.php --}}
@extends('layouts.public')

@section('title', $post->title . ' - MTec')

@section('content')
<style>
    .post-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .post-header h1 {
        font-size: 2.5rem;
        margin: 1rem 0;
    }
    
    .post-featured-image {
        width: 100%;
        max-height: 500px;
        object-fit: cover;
        border-radius: var(--border-radius);
        margin-bottom: 2rem;
    }
    
    .post-meta-large {
        display: flex;
        justify-content: center;
        gap: 2rem;
        margin-bottom: 2rem;
        padding: 1rem;
        background: var(--white);
        border-radius: var(--border-radius);
    }
    
    .post-content {
        background: var(--white);
        padding: 2rem;
        border-radius: var(--border-radius);
        margin-bottom: 2rem;
        line-height: 1.8;
    }
    
    .post-content h2 {
        margin: 1.5rem 0 1rem;
        color: var(--primary-color);
    }
    
    .post-content h3 {
        margin: 1rem 0;
    }
    
    .post-content p {
        margin-bottom: 1rem;
    }
    
    .post-content img {
        max-width: 100%;
        height: auto;
        border-radius: var(--border-radius);
        margin: 1rem 0;
    }
    
    .post-content pre {
        background: var(--gray-light);
        padding: 1rem;
        border-radius: var(--border-radius);
        overflow-x: auto;
        margin: 1rem 0;
    }
    
    .post-content code {
        background: var(--gray-light);
        padding: 0.2rem 0.4rem;
        border-radius: 4px;
        font-family: monospace;
    }
    
    .related-posts {
        margin-top: 3rem;
    }
    
    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-top: 1.5rem;
    }
    
    .related-card {
        background: var(--white);
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--shadow);
    }
    
    .related-card img {
        width: 100%;
        height: 150px;
        object-fit: cover;
    }
    
    .related-card-content {
        padding: 1rem;
    }
    
    .share-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin: 2rem 0;
    }
    
    .share-btn {
        padding: 0.5rem 1rem;
        border: none;
        border-radius: var(--border-radius);
        cursor: pointer;
        color: white;
        transition: opacity 0.3s;
    }
    
    .share-btn:hover {
        opacity: 0.8;
    }
    
    .share-facebook { background: #3b5998; }
    .share-twitter { background: #1da1f2; }
    .share-linkedin { background: #0077b5; }
    .share-whatsapp { background: #25d366; }
    
    @media (max-width: 768px) {
        .post-header h1 {
            font-size: 1.8rem;
        }
        
        .post-meta-large {
            flex-direction: column;
            gap: 0.5rem;
            text-align: center;
        }
        
        .post-content {
            padding: 1rem;
        }
    }
</style>

<article>
    <div class="post-header">
        <a href="{{ route('categories.posts', $post->category->slug) }}" class="post-category">
            {{ $post->category->name }}
        </a>
        <h1>{{ $post->title }}</h1>
    </div>
    
    @if($post->image)
        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="post-featured-image">
    @endif
    
    <div class="post-meta-large">
        <div class="post-author">
            <img src="{{ $post->user->avatar_url }}" alt="{{ $post->user->name }}" class="author-avatar-small">
            <span>Por <strong>{{ $post->user->name }}</strong></span>
        </div>
        <span>📅 {{ $post->published_at_date }}</span>
        <span>⏱️ {{ $post->reading_time }}</span>
        <span>👁️ {{ $post->views ?? 0 }} visualizações</span>
    </div>
    
    <div class="post-content">
        {!! $post->content !!}
    </div>
    
    <div class="share-buttons">
        <button class="share-btn share-facebook" onclick="shareOnFacebook()">Compartilhar no Facebook</button>
        <button class="share-btn share-twitter" onclick="shareOnTwitter()">Compartilhar no Twitter</button>
        <button class="share-btn share-linkedin" onclick="shareOnLinkedIn()">Compartilhar no LinkedIn</button>
        <button class="share-btn share-whatsapp" onclick="shareOnWhatsApp()">Compartilhar no WhatsApp</button>
    </div>
    
    @if($relatedPosts->count() > 0)
        <div class="related-posts">
            <h3>Posts Relacionados</h3>
            <div class="related-grid">
                @foreach($relatedPosts as $related)
                    <div class="related-card">
                        @if($related->image)
                            <img src="{{ $related->image_url }}" alt="{{ $related->title }}">
                        @endif
                        <div class="related-card-content">
                            <h4>
                                <a href="{{ route('posts.show', $related->slug) }}">
                                    {{ $related->title }}
                                </a>
                            </h4>
                            <p>{{ $related->excerpt_html }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</article>

<script>
    function shareOnFacebook() {
        window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(window.location.href), '_blank', 'width=600,height=400');
    }
    
    function shareOnTwitter() {
        window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent('{{ $post->title }}') + '&url=' + encodeURIComponent(window.location.href), '_blank', 'width=600,height=400');
    }
    
    function shareOnLinkedIn() {
        window.open('https://www.linkedin.com/shareArticle?mini=true&url=' + encodeURIComponent(window.location.href) + '&title=' + encodeURIComponent('{{ $post->title }}'), '_blank', 'width=600,height=400');
    }
    
    function shareOnWhatsApp() {
        window.open('https://wa.me/?text=' + encodeURIComponent('{{ $post->title }} - ' + window.location.href), '_blank');
    }
</script>
@endsection