<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'published_at',
        'user_id',
        'category_id',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Boot method para gerar slug automaticamente
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });

        static::updating(function ($post) {
            if ($post->isDirty('title')) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    // Relacionamentos
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function approvedComments()
    {
        return $this->hasMany(Comment::class)->where('is_approved', true);
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now());
    }

    public function scopeDrafts($query)
    {
        return $query->whereNull('published_at')->orWhere('published_at', '>', now());
    }

    public function scopeByCategory($query, $categorySlug)
    {
        return $query->whereHas('category', function ($q) use ($categorySlug) {
            $q->where('slug', $categorySlug);
        });
    }

    public function scopeByAuthor($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeSearch($query, $searchTerm)
    {
        return $query->where('title', 'LIKE', "%{$searchTerm}%")
                     ->orWhere('content', 'LIKE', "%{$searchTerm}%")
                     ->orWhere('excerpt', 'LIKE', "%{$searchTerm}%");
    }

    // Accessors
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/default-post.jpg');
    }

    public function getPublishedAtFormattedAttribute()
    {
        return $this->published_at ? $this->published_at->format('d/m/Y H:i') : 'Não publicado';
    }

    public function getPublishedAtDateAttribute()
    {
        return $this->published_at ? $this->published_at->format('d/m/Y') : null;
    }

    public function getReadingTimeAttribute()
    {
        $words = str_word_count(strip_tags($this->content));
        $minutes = ceil($words / 200); // Média de 200 palavras por minuto
        return $minutes . ' min de leitura';
    }

    public function getExcerptHtmlAttribute()
    {
        return Str::limit(strip_tags($this->excerpt), 150);
    }

    // Métodos de verificação
    public function isPublished()
    {
        return $this->published_at && $this->published_at <= now();
    }

    public function isScheduled()
    {
        return $this->published_at && $this->published_at > now();
    }

    public function canBeEditedBy(User $user)
    {
        return $user->isAdmin() || $user->id === $this->user_id;
    }
}