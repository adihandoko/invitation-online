<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreweddingPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitation_id',
        'photo_path',
        // Tambahkan atribut lain yang diperlukan
    ];

    // Relasi dengan Invitation
    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }
}
