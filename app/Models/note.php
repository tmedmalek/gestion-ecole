<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'note',
    ];

    public function trimestre()
    {
        return $this->belongsTo(Trimestre::class);
    }
    

    public function bulletin()
    {
        return $this->belongsTo(Bulletin::class);
    }
}
