{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('title', 'Dashboard - MTec')

@section('content')
<style>
    .dashboard-stats {
        margin-bottom: 2rem;
    }
    
    .stat-card {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
        border-radius: 10px;
        padding: 1.5rem;
        height: 100%;
        transition: transform 0.3s;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
    }
    
    .stat-icon {
        font-size: 2.5rem;
        opacity: 0.8;
        margin-bottom: 1rem;
    }
    
    .stat-number {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }
    
    .stat-label {
        font-size: 0.9rem;
        opacity: 0.9;
    }
    
    .chart-container {
        background: white;
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
        margin-bottom: 1.5rem;
    }
    
    .quick-actions {
        background: white;
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
        margin-bottom: 1.5rem;
    }
    
    .quick-actions h5 {
        margin-bottom: 1rem;
        font-weight: 600;
    }
    
    .quick-actions .btn {
        margin-bottom: 0.5rem;
    }
    
    .activity-timeline {
        background: white;
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    
    .timeline-item {
        display: flex;
        gap: 1rem;
        padding: 1rem 0;
        border-bottom: 1px solid #eee;
    }
    
    .timeline-item:last-child {
        border-bottom: none;
    }
    
    .timeline-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }
    
    .timeline-icon.post {
        background: #e3f2fd;
        color: #1976d2;
    }
    
    .timeline-icon.user {
        background: #e8f5e9;
        color: #388e3c;
    }
    
    .timeline-icon.comment {
        background: #fff3e0;
        color: #f57c00;
    }
    
    .timeline-content {
        flex: 1;
    }
    
    .timeline-title {
        font-weight: 600;
        margin-bottom: 0.25rem;
    }
    
    .timeline-time {
        font-size: 0.8rem;
        color: #666;
    }
    
    .welcome-banner {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 10px;
        padding: 2rem;
        margin-bottom: 2rem;
    }
    
    .welcome-banner h2 {
        margin-bottom: 0.5rem;
    }
    
    .welcome-banner p {
        margin-bottom: 0;
        opacity: 0.9;
    }
    
    @media (max-width: 768px) {
        .stat-card {
            margin-bottom: 1rem;
        }
        
        .welcome-banner {
            padding: 1.5rem;
        }
        
        .welcome-banner h2 {
            font-size: 1.5rem;
        }
    }
</style>

<div class="container-fluid">
    <!-- Welcome Banner -->
    <div class="welcome-banner">
        <h2>Bem-vindo(a) de volta, {{ Auth::user()->name }}! 👋</h2>
        <p>Este é o painel de controle do MTec. Aqui você pode gerenciar todo o conteúdo do blog.</p>
    </div>
    
    <!-- Statistics Cards -->
    <div class="row dashboard-stats">
        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-file-text"></i>
                </div>
                <div class="stat-number">{{ $stats['total_posts'] }}</div>
                <div class="stat-label">Total de Posts</div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="stat-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="stat-icon">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stat-number">{{ $stats['published_posts'] }}</div>
                <div class="stat-label">Posts Publicados</div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="stat-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <div class="stat-icon">
                    <i class="bi bi-tags"></i>
                </div>
                <div class="stat-number">{{ $stats['total_categories'] }}</div>
                <div class="stat-label">Categorias</div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="stat-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                <div class="stat-icon">
                    <i class="bi bi-people"></i>
                </div>
                <div class="stat-number">{{ $stats['total_authors'] }}</div>
                <div class="stat-label">Autores</div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-8">
            <!-- Recent Posts -->
            <div class="chart-container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">
                        <i class="bi bi-clock-history me-2"></i>
                        Posts Recentes
                    </h5>
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-sm btn-outline-primary">
                        Ver todos
                    </a>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Categoria</th>
                                <th>Autor</th>
                                <th>Status</th>
                                <th>Data</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPosts as $post)
                                <tr>
                                    <td>
                                        <a href="{{ route('posts.show', $post->slug) }}" target="_blank">
                                            {{ Str::limit($post->title, 40) }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">
                                            {{ $post->category->name }}
                                        </span>
                                    </td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>
                                        @if($post->isPublished())
                                            <span class="badge bg-success">Publicado</span>
                                        @elseif($post->isScheduled())
                                            <span class="badge bg-warning">Agendado</span>
                                        @else
                                            <span class="badge bg-secondary">Rascunho</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $post->created_at->format('d/m/Y') }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.posts.edit', $post) }}" 
                                           class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        Nenhum post encontrado.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Popular Posts -->
            <div class="chart-container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">
                        <i class="bi bi-graph-up me-2"></i>
                        Posts Mais Vistos
                    </h5>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Visualizações</th>
                                <th>Categoria</th>
                                <th>Autor</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($popularPosts as $post)
                                <tr>
                                    <td>
                                        <a href="{{ route('posts.show', $post->slug) }}" target="_blank">
                                            {{ Str::limit($post->title, 40) }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">
                                            {{ number_format($post->views ?? 0) }} visualizações
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">
                                            {{ $post->category->name }}
                                        </span>
                                    </td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.posts.edit', $post) }}" 
                                           class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        Nenhum post encontrado.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Right Column -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="quick-actions">
                <h5>
                    <i class="bi bi-lightning-charge me-2"></i>
                    Ações Rápidas
                </h5>
                
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>
                        Novo Post
                    </a>
                    
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-success">
                            <i class="bi bi-folder-plus me-2"></i>
                            Nova Categoria
                        </a>
                        
                        <a href="{{ route('admin.users.create') }}" class="btn btn-info text-white">
                            <i class="bi bi-person-plus me-2"></i>
                            Novo Autor
                        </a>
                    @endif
                    
                    <a href="{{ route('admin.profile.edit') }}" class="btn btn-secondary">
                        <i class="bi bi-person-circle me-2"></i>
                        Editar Perfil
                    </a>
                </div>
            </div>
            
            <!-- Recent Users (Only for Admin) -->
            @if(Auth::user()->isAdmin())
                <div class="quick-actions">
                    <h5>
                        <i class="bi bi-people me-2"></i>
                        Últimos Usuários
                    </h5>
                    
                    @forelse($recentUsers as $user)
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex align-items-center gap-2">
                                <img src="{{ $user->avatar_url }}" 
                                     alt="{{ $user->name }}" 
                                     style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                                <div>
                                    <div class="fw-bold">{{ $user->name }}</div>
                                    <div class="small text-muted">{{ $user->email }}</div>
                                </div>
                            </div>
                            <span class="badge bg-{{ $user->isAdmin() ? 'danger' : 'info' }}">
                                {{ $user->role_label }}
                            </span>
                        </div>
                    @empty
                        <p class="text-muted text-center">Nenhum usuário encontrado.</p>
                    @endforelse
                    
                    <div class="mt-3 text-center">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-primary">
                            Ver todos os usuários
                        </a>
                    </div>
                </div>
            @endif
            
            <!-- Activity Timeline -->
            <div class="activity-timeline">
                <h5>
                    <i class="bi bi-activity me-2"></i>
                    Atividades Recentes
                </h5>
                
                @php
                    $activities = [];
                    
                    // Simular algumas atividades (você pode implementar um sistema real de logs)
                    if(isset($recentPosts) && $recentPosts->count() > 0) {
                        foreach($recentPosts->take(3) as $post) {
                            $activities[] = [
                                'type' => 'post',
                                'title' => "Novo post criado: {$post->title}",
                                'time' => $post->created_at->diffForHumans(),
                                'user' => $post->user->name
                            ];
                        }
                    }
                    
                    if(isset($recentUsers) && $recentUsers->count() > 0 && Auth::user()->isAdmin()) {
                        foreach($recentUsers->take(2) as $user) {
                            $activities[] = [
                                'type' => 'user',
                                'title' => "Novo usuário registrado: {$user->name}",
                                'time' => $user->created_at->diffForHumans(),
                                'user' => $user->name
                            ];
                        }
                    }
                @endphp
                
                @forelse($activities as $activity)
                    <div class="timeline-item">
                        <div class="timeline-icon {{ $activity['type'] }}">
                            <i class="bi bi-{{ $activity['type'] == 'post' ? 'file-text' : ($activity['type'] == 'user' ? 'person' : 'chat') }}"></i>
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-title">{{ $activity['title'] }}</div>
                            <div class="timeline-time">{{ $activity['time'] }}</div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted text-center py-3">
                        Nenhuma atividade recente.
                    </p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Gráfico de posts por mês (opcional)
    document.addEventListener('DOMContentLoaded', function() {
        // Você pode adicionar um gráfico aqui se tiver os dados
        // Exemplo de como implementar:
        
        @if(isset($postsByMonth))
            const ctx = document.getElementById('postsChart');
            if(ctx) {
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($postsByMonth['labels']) !!},
                        datasets: [{
                            label: 'Posts Publicados',
                            data: {!! json_encode($postsByMonth['data']) !!},
                            borderColor: '#0D8F81',
                            backgroundColor: 'rgba(13, 143, 129, 0.1)',
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                            }
                        }
                    }
                });
            }
        @endif
    });
</script>
@endpush