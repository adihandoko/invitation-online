<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne; // Perbaiki import ini

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'event_date', 'event_location', 'event_category_id', 'slug'
    ];

    // Relasi dengan model EventCategory
    public function eventCategory()
    {
        return $this->belongsTo(EventCategory::class);
    }

    // Tambahkan relasi wedding
    public function wedding(): HasOne
    {
        return $this->hasOne(Wedding::class);
    }
    public function preweddingPhotos()
    {
        return $this->hasMany(PreweddingPhoto::class);
    }

    public function generateSlug()
    {
        return Str::slug($this->name);
    }

    public function getSlugAttribute($value)
    {
        return $value ?: $this->generateSlug();
    }


}
