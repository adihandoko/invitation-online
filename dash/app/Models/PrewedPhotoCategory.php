<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrewedPhotoCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    public function preweddingPhotos()
    {
        return $this->hasMany(PreweddingPhoto::class, 'category_id');
    }
}
