<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'note',
        'eleve_id',
        'matiere_id',
        'bulletin_id',
        'trimestre_id',

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
