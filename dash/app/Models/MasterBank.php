<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterBank extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_bank' , 'logo_url'
    ];
    public function rekeningTransfers()
    {
        return $this->hasMany(RekeningTransfer::class);
    }
}
