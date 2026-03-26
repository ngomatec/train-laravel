{{-- resources/views/about.blade.php --}}
@extends('layouts.public')

@section('title', 'Sobre - MTec')

@section('content')
<style>
    .about-hero {
        text-align: center;
        margin-bottom: 3rem;
    }
    
    .about-hero h1 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
        margin: 3rem 0;
    }
    
    .stat-card {
        background: var(--white);
        padding: 2rem;
        text-align: center;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
    }
    
    .stat-number-large {
        font-size: 3rem;
        font-weight: bold;
        color: var(--primary-color);
    }
    
    .stat-label-large {
        font-size: 1rem;
        color: var(--text-light);
        margin-top: 0.5rem;
    }
    
    .mission-section {
        background: var(--white);
        padding: 2rem;
        border-radius: var(--border-radius);
        margin-bottom: 2rem;
    }
    
    .mission-section h2 {
        color: var(--primary-color);
        margin-bottom: 1rem;
    }
    
    .values-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        margin: 2rem 0;
    }
    
    .value-item {
        text-align: center;
        padding: 1.5rem;
    }
    
    .value-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }
    
    .contact-info {
        background: var(--white);
        padding: 2rem;
        border-radius: var(--border-radius);
        margin-top: 2rem;
    }
    
    .contact-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }
</style>

<div class="about-hero">
    <h1>Sobre o MTec</h1>
    <p>Conheça nossa história, missão e valores</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-number-large">{{ $totalPosts }}</div>
        <div class="stat-label-large">Posts Publicados</div>
    </div>
    <div class="stat-card">
        <div class="stat-number-large">{{ $totalAuthors }}</div>
        <div class="stat-label-large">Autores</div>
    </div>
    <div class="stat-card">
        <div class="stat-number-large">{{ $totalCategories }}</div>
        <div class="stat-label-large">Categorias</div>
    </div>
</div>

<div class="mission-section">
    <h2>Nossa Missão</h2>
    <p>Democratizar o conhecimento em tecnologia, oferecendo conteúdo de qualidade, acessível e atualizado para profissionais e entusiastas da área de TI.</p>
</div>

<div class="mission-section">
    <h2>Nossa Visão</h2>
    <p>Ser referência em conteúdo técnico no Brasil, inspirando e capacitando a próxima geração de profissionais de tecnologia.</p>
</div>

<h2>Nossos Valores</h2>
<div class="values-grid">
    <div class="value-item">
        <div class="value-icon">🎯</div>
        <h3>Qualidade</h3>
        <p>Conteúdo técnico preciso e bem pesquisado</p>
    </div>
    <div class="value-item">
        <div class="value-icon">🤝</div>
        <h3>Comunidade</h3>
        <p>Construímos conhecimento junto com nossa comunidade</p>
    </div>
    <div class="value-item">
        <div class="value-icon">💡</div>
        <h3>Inovação</h3>
        <p>Sempre atualizados com as últimas tecnologias</p>
    </div>
    <div class="value-item">
        <div class="value-icon">🌍</div>
        <h3>Acessibilidade</h3>
        <p>Conhecimento livre e acessível para todos</p>
    </div>
</div>

<div class="contact-info">
    <h2>Entre em Contato</h2>
    <div class="contact-item">
        <span>📧</span>
        <span>contato@mtec.com.br</span>
    </div>
    <div class="contact-item">
        <span>📱</span>
        <span>(11) 99999-9999</span>
    </div>
    <div class="contact-item">
        <span>📍</span>
        <span>São Paulo, SP - Brasil</span>
    </div>
</div>
@endsection