<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('site/about/index');
});

Route::any('/any', function () {
    return 'Permite todo tipo de acesso, GET, POST, PUT, DELETE, PATCH, OPTIONS.';
});

Route::match(['get', 'post'], '/match', function () {
    return 'Permite apenas os métodos definidos neste caso: GET e POST.';
});

Route::get('/product/{id}/{cat}/{op?}', function ($id, $cat, $op = null) {
    return "Product - ID: $id, Categoria: $cat, Opção: $op.";
});

Route::redirect('/about-as', '/about');

Route::view('/contact', 'site/about/contact')->name('my.contact');

Route::get('/my-contact', function () {
    return redirect()->route('my.contact');
});

# 
Route::prefix('blog')->group(function() {
    Route::get('/post', function() {
        return 'posts';
    });

    Route::get('/post/{slug}', function(string $slug) {
        return "single post {$slug}";
    });

    Route::get('/category', function() {
        return 'categories of post';
    });
});
