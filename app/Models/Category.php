<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    // Boot method para gerar slug automaticamente
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('name')) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    // Relacionamentos
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function publishedPosts()
    {
        return $this->hasMany(Post::class)->where('published_at', '<=', now());
    }

    // Scopes
    public function scopeWithPostsCount($query)
    {
        return $query->withCount('posts');
    }

    public function scopeHasPosts($query)
    {
        return $query->has('posts');
    }

    // Accessors
    public function getPostsCountAttribute()
    {
        return $this->posts()->count();
    }

    public function getPublishedPostsCountAttribute()
    {
        return $this->publishedPosts()->count();
    }

    public function getUrlAttribute()
    {
        return route('categories.posts', $this->slug);
    }
}