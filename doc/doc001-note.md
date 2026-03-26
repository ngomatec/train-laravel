# 001 Treinamento laravel

## 1. Estruturas de pastas

## 2. Artisan

```bash
# list artisan commands
php artisan list

# start app web server
php artisan serve
# disable server
php artisan dow
# enable server
php artisan up

# show commands options
php artisan help migrate

# show active routes
php artisan route:list
# create file cache routes to faster route access
php artisan route:cache
# Remove cache route file
php artisan route:clear
```

## 3. Rotas

file `routes/web.php`

Add new route

```php
<?php

use Illuminate\Support\Facades\Route;

// dault url
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

// group routes by refix
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

// group routes by name
Route::name('admin.')->group(function() {
    Route::get('/admin/dashboard', function() {
        return 'admin dashboard';
    })->name('dashboard');
    
    Route::get('/admin/post', function() {
        return 'admin post';
    })->name('post');
});

# group routes by prefix end name
Route::group(['prefix'=>'person', 'as'=>'person.'], function() {
    Route::get('/', function() {
        return 'person datas';
    })->name('index');
    
    Route::get('local', function() {
        return 'person local';
    })->name('lcoal');
    
    Route::get('contact', function() {
        return 'person contact';
    })->name('contact');
});
```

## 4. Controller

path `app/Http/Controllers`

```bash
# create in terminal controller
php artisan make:controller HomeContoller

# create route resource
php artisan make:controller ProductContoller --resource
```

create route to controller

```php
<?php
namespace App\Http\Controllers;

Route::get('/about', [HomeController::class, 'index']);

# route resource
# atation is `products` no `product`
Route::resource('products', ProductContoller::class);
```

## 5. Migrations

path `database/migrations`.

```bash
# create migrations
php artisan make:migration create_products_table
#or
php artisan make:migration --create=products

# execute migrateions
php artisan migrate

# change table name
php artisan make:migration alter_products_table_name
```

```php
# in up function
public function up() {
    Schema::rename('products', 'products_sp');
}

```

```bash
php artisan migrate:fresh
php artisan migrate:install
php artisan migrate:refresh
php artisan migrate:reset
php artisan migrate:rollback
php artisan migrate:status

# drop table
php artisan make:migration drop_products_table
```

```php
# in up function
public function up() {
    Schema::dropIfExists('products');
}
