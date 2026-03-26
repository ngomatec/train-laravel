{{-- resources/views/partials/sidebar.blade.php --}}
<style>
    .sidebar {
        background: var(--white);
        padding: 1.5rem;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
    }
    
    .sidebar-widget {
        margin-bottom: 2rem;
    }
    
    .sidebar-widget h3 {
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--primary-color);
    }
    
    .category-list {
        list-style: none;
    }
    
    .category-list li {
        margin-bottom: 0.5rem;
    }
    
    .category-list a {
        color: var(--text-dark);
        text-decoration: none;
        display: flex;
        justify-content: space-between;
        transition: color 0.3s;
    }
    
    .category-list a:hover {
        color: var(--primary-color);
    }
    
    .category-count {
        color: var(--text-light);
        font-size: 0.9rem;
    }
    
    .author-list {
        list-style: none;
    }
    
    .author-list li {
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .author-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
    }
    
    .author-info h4 {
        margin-bottom: 0.25rem;
    }
    
    .author-info p {
        font-size: 0.85rem;
        color: var(--text-light);
    }
    
    .author-info a {
        text-decoration: none;
        color: var(--text-dark);
    }
    
    .author-info a:hover {
        color: var(--primary-color);
    }
</style>

<aside class="sidebar">
    <div class="sidebar-widget">
        <h3>Categorias</h3>
        <ul class="category-list">
            @foreach($categories ?? [] as $category)
                <li>
                    <a href="{{ route('categories.posts', $category->slug) }}">
                        {{ $category->name }}
                        <span class="category-count">({{ $category->posts_count ?? $category->posts->count() }})</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    
    <div class="sidebar-widget">
        <h3>Autores em Destaque</h3>
        <ul class="author-list">
            @foreach($popularAuthors ?? [] as $author)
                <li>
                    <img src="{{ $author->avatar_url }}" alt="{{ $author->name }}" class="author-avatar">
                    <div class="author-info">
                        <h4>
                            <a href="{{ route('authors.posts', $author->id) }}">
                                {{ $author->name }}
                            </a>
                        </h4>
                        <p>{{ $author->posts_count ?? $author->posts->count() }} posts</p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</aside>