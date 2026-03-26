<?php
// app/Traits/Sluggable.php

namespace App\Traits;

use Illuminate\Support\Str;

trait Sluggable
{
    public static function bootSluggable()
    {
        static::creating(function ($model) {
            $model->generateSlug();
        });

        static::updating(function ($model) {
            if ($model->isDirty('name') || $model->isDirty('title')) {
                $model->generateSlug();
            }
        });
    }

    public function generateSlug()
    {
        $source = $this->name ?? $this->title ?? '';
        $this->slug = Str::slug($source);
    }
}