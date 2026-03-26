<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    PostController,
    CategoryController,
    AuthorController,
    DashboardController,
    SearchController,
    CommentController,
    ProfileController,
    Auth\AuthenticatedSessionController,
    Auth\RegisteredUserController
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

// Rotas de Autenticação (Laravel 12)
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

// Rotas do Painel Administrativo usando grupos de middleware
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Gerenciamento de Posts
    Route::get('/posts', [PostController::class, 'adminIndex'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    
    // Gerenciamento de Categorias (apenas admin)
    Route::middleware('admin-only')->group(function () {
        Route::get('/categories', [CategoryController::class, 'adminIndex'])->name('categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });
    
    // Gerenciamento de Usuários (apenas admin)
    Route::middleware('admin-only')->group(function () {
        Route::get('/users', [AuthorController::class, 'adminIndex'])->name('users.index');
        Route::get('/users/create', [AuthorController::class, 'create'])->name('users.create');
        Route::post('/users', [AuthorController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [AuthorController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [AuthorController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [AuthorController::class, 'destroy'])->name('users.destroy');
    });
    
    // Gerenciamento de Comentários (opcional - apenas admin)
    Route::prefix('comments')->name('comments.')->middleware('admin-only')->group(function () {
        Route::get('/', [CommentController::class, 'adminIndex'])->name('index');
        Route::patch('/{comment}/approve', [CommentController::class, 'approve'])->name('approve');
        Route::delete('/{comment}', [CommentController::class, 'destroy'])->name('destroy');
    });
    
    // Perfil do Usuário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});