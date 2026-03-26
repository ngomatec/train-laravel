<?php
// with breeze
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    PostController,
    CategoryController,
    AuthorController,
    DashboardController,
    SearchController,
    CommentController
};

// Rotas Públicas
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sobre', [HomeController::class, 'about'])->name('about');

// Posts
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');

// Categorias
Route::get('/categorias', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categorias/{slug}', [PostController::class, 'byCategory'])->name('categories.posts');

// Autores
Route::get('/autores', [AuthorController::class, 'index'])->name('authors.index');
Route::get('/autores/{id}', [PostController::class, 'byAuthor'])->name('authors.posts');

// Busca
Route::get('/buscar', [SearchController::class, 'search'])->name('search');

// Comentários (Público)
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

// Rotas de Autenticação (geradas pelo Laravel Breeze/Sanctum)
require __DIR__.'/auth.php';

// Rotas do Painel Administrativo (protegidas por autenticação)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Gerenciamento de Posts
    Route::resource('posts', PostController::class)
        ->except(['show', 'index'])
        ->parameter('posts', 'post');
    Route::get('/posts', [PostController::class, 'adminIndex'])->name('posts.index');
    
    // Gerenciamento de Categorias (apenas admin)
    Route::middleware(['can:manage-categories'])->group(function () {
        Route::resource('categories', CategoryController::class)
            ->except(['show'])
            ->parameter('categories', 'category');
        Route::get('/categories', [CategoryController::class, 'adminIndex'])->name('categories.index');
    });
    
    // Gerenciamento de Usuários (apenas admin)
    Route::middleware(['can:manage-users'])->group(function () {
        Route::resource('users', AuthorController::class)
            ->except(['show'])
            ->parameter('users', 'user');
        Route::get('/users', [AuthorController::class, 'adminIndex'])->name('users.index');
    });
    
    // Gerenciamento de Comentários (opcional - apenas admin)
    Route::prefix('comments')->name('comments.')->group(function () {
        Route::get('/', [CommentController::class, 'adminIndex'])->name('index');
        Route::patch('/{comment}/approve', [CommentController::class, 'approve'])->name('approve');
        Route::delete('/{comment}', [CommentController::class, 'destroy'])->name('destroy');
    });
    
    // Perfil do Usuário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});