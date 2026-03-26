{{-- resources/views/partials/footer.blade.php --}}
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h3>MTec</h3>
                <p>Blog de tecnologia com os melhores conteúdos sobre programação, desenvolvimento web e inovação.</p>
            </div>
            
            <div class="footer-section">
                <h3>Links Rápidos</h3>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('posts.index') }}">Posts</a></li>
                    <li><a href="{{ route('categories.index') }}">Categorias</a></li>
                    <li><a href="{{ route('authors.index') }}">Autores</a></li>
                    <li><a href="{{ route('about') }}">Sobre</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Categorias</h3>
                <ul>
                    @php
                        $categories = \App\Models\Category::take(5)->get();
                    @endphp
                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('categories.posts', $category->slug) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Contato</h3>
                <p>Email: contato@mtec.com.br</p>
                <p>Telefone: (11) 99999-9999</p>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} MTec. Todos os direitos reservados.</p>
        </div>
    </div>
</footer>