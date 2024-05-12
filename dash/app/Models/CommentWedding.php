<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentWedding extends Model
{
    protected $fillable = ['name', 'comment', 'wedding_id'];

    public function wedding()
    {
        return $this->belongsTo(Wedding::class);
    }
}
