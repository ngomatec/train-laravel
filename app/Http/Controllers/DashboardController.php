<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_posts' => Post::count(),
            'published_posts' => Post::published()->count(),
            'total_categories' => Category::count(),
            'total_users' => User::count(),
            'total_authors' => User::authors()->count(),
        ];
        
        $recentPosts = Post::with(['user', 'category'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $popularPosts = Post::with(['user', 'category'])
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();
            
        $recentUsers = User::orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Dados para gráfico de posts por mês
        $postsByMonth = $this->getPostsByMonth();
            
        return view('admin.dashboard', compact(
            'stats', 
            'recentPosts', 
            'popularPosts', 
            'recentUsers',
            'postsByMonth'
        ));
    }
    
    private function getPostsByMonth()
    {
        $posts = Post::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('COUNT(*) as count')
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();
        
        $months = [
            1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril',
            5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto',
            9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'
        ];
        
        $labels = [];
        $data = [];
        
        for ($i = 1; $i <= 12; $i++) {
            $labels[] = $months[$i];
            $postCount = $posts->firstWhere('month', $i);
            $data[] = $postCount ? $postCount->count : 0;
        }
        
        return [
            'labels' => $labels,
            'data' => $data
        ];
    }
}