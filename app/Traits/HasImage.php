<?php
// app/Traits/HasImage.php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait HasImage
{
    public function uploadImage($file, $path = 'images')
    {
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs($path, $fileName, 'public');
        
        return $filePath;
    }

    public function deleteImage($field = 'image')
    {
        if ($this->$field && Storage::disk('public')->exists($this->$field)) {
            Storage::disk('public')->delete($this->$field);
        }
    }

    public function getImageUrl($field = 'image', $default = null)
    {
        if ($this->$field) {
            return asset('storage/' . $this->$field);
        }
        
        return $default ?? asset('images/default.jpg');
    }
}