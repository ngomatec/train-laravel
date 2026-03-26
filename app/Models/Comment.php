<?php
// app/Models/Comment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_name',
        'author_email',
        'content',
        'is_approved',
        'post_id',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    // Relacionamentos
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Scopes
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopePending($query)
    {
        return $query->where('is_approved', false);
    }

    // Accessors
    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at->format('d/m/Y H:i');
    }

    public function getExcerptAttribute()
    {
        return Str::limit(strip_tags($this->content), 100);
    }
}