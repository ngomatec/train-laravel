<?php
// app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $latestPosts = Post::published()
            ->with(['user', 'category'])
            ->orderBy('published_at', 'desc')
            ->take(6)
            ->get();
            
        $featuredCategories = Category::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->take(5)
            ->get();
            
        $popularPosts = Post::published()
            ->with(['user', 'category'])
            ->orderBy('views', 'desc')
            ->take(4)
            ->get();
            
        return view('home', compact('latestPosts', 'featuredCategories', 'popularPosts'));
    }
    
    public function about()
    {
        $totalPosts = Post::published()->count();
        $totalAuthors = User::authors()->count();
        $totalCategories = Category::count();
        
        return view('about', compact('totalPosts', 'totalAuthors', 'totalCategories'));
    }
}