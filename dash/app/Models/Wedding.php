<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wedding extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitation_id',
        'bride_name',
        'groom_name',
        'wedding_venue',
        'number_of_guests',
        // Tambahkan atribut lainnya sesuai kebutuhan
    ];

    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }
}
