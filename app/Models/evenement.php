<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'adresse',
        'date',
        'heure_debut',
        'heure_fin',
    ];

    public function eleves()
    {
        return $this->belongsToMany(Eleve::class, 'participations');
    }
}
