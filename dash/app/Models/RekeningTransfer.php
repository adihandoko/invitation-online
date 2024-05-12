<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekeningTransfer extends Model
{
    use HasFactory;

    protected $fillable = ['nomor_rekening', 'atas_nama', 'wedding_id','master_bank_id'];

    // Define the relationship with Wedding model
    public function wedding()
    {
        return $this->belongsTo(Wedding::class);
    }

    public function masterBank()
    {
        return $this->belongsTo(MasterBank::class);
    }
}
