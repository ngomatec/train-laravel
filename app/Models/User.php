<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'role',
        'bio',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relacionamentos
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Scopes
    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeAuthors($query)
    {
        return $query->where('role', 'author');
    }

    // Accessors
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }
        return 'https://ui-avatars.com/api/?background=0D8F81&color=fff&name=' . urlencode($this->name);
    }

    public function getRoleLabelAttribute()
    {
        return $this->role === 'admin' ? 'Administrador' : 'Autor';
    }

    // Métodos de verificação
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isAuthor()
    {
        return $this->role === 'author';
    }

    public function canManagePosts()
    {
        return $this->isAdmin() || $this->isAuthor();
    }
    
    public function canManageCategories()
    {
        return $this->isAdmin();
    }
    
    public function canManageUsers()
    {
        return $this->isAdmin();
    }
}