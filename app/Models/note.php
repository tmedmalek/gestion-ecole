<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class note extends Model
{
    use HasFactory;

    protected $fillable = [
        'note',
    ];

    public function trimestre()
    {
        return $this->belongsTo(trimestre::class);
    }
    

    public function bulletin()
    {
        return $this->belongsTo(Bulletin::class);
    }
}
