{{-- resources/views/layouts/public.blade.php --}}
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MTec - Blog de Tecnologia com os melhores conteúdos sobre programação, desenvolvimento web e inovação">
    <meta name="keywords" content="tecnologia, programação, blog, laravel, php, javascript">
    <meta name="author" content="MTec">
    <title>@yield('title', 'MTec - Blog de Tecnologia')</title>
    
    <!-- CSS Puro -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        :root {
            --primary-color: #0D8F81;
            --primary-dark: #0A6B60;
            --secondary-color: #2C3E50;
            --accent-color: #E67E22;
            --text-dark: #2C3E50;
            --text-light: #7F8C8D;
            --background: #F5F7FA;
            --white: #FFFFFF;
            --gray-light: #ECF0F1;
            --gray: #BDC3C7;
            --danger: #E74C3C;
            --success: #27AE60;
            --shadow: 0 2px 4px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 25px -5px rgba(0,0,0,0.1);
            --border-radius: 8px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background);
            color: var(--text-dark);
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Header Styles */
        .header {
            background: var(--white);
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }
        
        .logo {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .logo:hover {
            color: var(--primary-dark);
        }
        
        .logo span {
            color: var(--accent-color);
        }
        
        /* Navigation */
        .nav {
            display: flex;
            gap: 2rem;
            align-items: center;
        }
        
        .nav-link {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 500;
            transition: color 0.3s;
            position: relative;
        }
        
        .nav-link:hover {
            color: var(--primary-color);
        }
        
        .nav-link.active {
            color: var(--primary-color);
        }
        
        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--primary-color);
        }
        
        /* Search Bar */
        .search-form {
            display: flex;
            gap: 0.5rem;
        }
        
        .search-input {
            padding: 0.5rem 1rem;
            border: 1px solid var(--gray);
            border-radius: var(--border-radius);
            font-size: 0.9rem;
            width: 200px;
            transition: all 0.3s;
        }
        
        .search-input:focus {
            outline: none;
            border-color: var(--primary-color);
            width: 250px;
        }
        
        .search-btn {
            padding: 0.5rem 1rem;
            background: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .search-btn:hover {
            background: var(--primary-dark);
        }
        
        /* Mobile Menu */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-dark);
        }
        
        /* Main Content */
        .main {
            min-height: calc(100vh - 300px);
            padding: 3rem 0;
        }
        
        /* Footer */
        .footer {
            background: var(--secondary-color);
            color: var(--white);
            padding: 3rem 0 1rem;
            margin-top: 3rem;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .footer-section h3 {
            margin-bottom: 1rem;
            color: var(--primary-color);
        }
        
        .footer-section ul {
            list-style: none;
        }
        
        .footer-section ul li {
            margin-bottom: 0.5rem;
        }
        
        .footer-section a {
            color: var(--gray-light);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-section a:hover {
            color: var(--primary-color);
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        
        /* Alert Messages */
        .alert {
            padding: 1rem;
            border-radius: var(--border-radius);
            margin-bottom: 1rem;
            animation: slideDown 0.3s ease;
        }
        
        .alert-success {
            background: var(--success);
            color: white;
        }
        
        .alert-error {
            background: var(--danger);
            color: white;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }
            
            .nav {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: var(--white);
                flex-direction: column;
                padding: 1rem;
                box-shadow: var(--shadow);
                gap: 1rem;
            }
            
            .nav.active {
                display: flex;
            }
            
            .search-form {
                width: 100%;
            }
            
            .search-input {
                flex: 1;
            }
            
            .search-input:focus {
                width: 100%;
            }
            
            .header-content {
                flex-wrap: wrap;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    @include('partials.header')
    
    <main class="main">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif
            
            @yield('content')
        </div>
    </main>
    
    @include('partials.footer')
    
    <!-- JavaScript Puro -->
    <script>
        // Mobile Menu Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileBtn = document.querySelector('.mobile-menu-btn');
            const nav = document.querySelector('.nav');
            
            if (mobileBtn) {
                mobileBtn.addEventListener('click', function() {
                    nav.classList.toggle('active');
                });
            }
            
            // Auto-hide alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    setTimeout(() => {
                        alert.remove();
                    }, 300);
                }, 5000);
            });
        });
        
        // Search form validation
        function validateSearch(form) {
            const input = form.querySelector('.search-input');
            if (input.value.trim() === '') {
                alert('Por favor, digite um termo para buscar');
                return false;
            }
            return true;
        }
    </script>
    
    @stack('scripts')
</body>
</html>