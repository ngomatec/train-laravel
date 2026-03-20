# 001 Treinamento laravel

## 1. Estruturas de pastas

## 2. Artisan

```bash
# list artisan commands
php artisan list

# server
php artisan serve

php artisan dow
php artisan up

# show commands options
php artisan help migrate
```

## 3. Rotas

file `routes/web.php`

Add new route

```php
<?php

use Illuminate\Support\Facades\Route;

// fault url
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

// redirect
Route::get('/sobre-nos', function() {
    return redirect('/about');
});
// or
Route::redirect('/about-as', '/about');

Route::view('/contact', 'site/about/contact');

// name
Route::view('/contact', 'site/about/contact')->name('my.contact');
```
