<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class seance extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'date_seance',
        'heure_debut',
        'heure_fen',
    ];
}
