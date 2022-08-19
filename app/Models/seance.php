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

    public function classe()
    {
        return $this->belongsTo(classe::class);
    }

    public function matiere_prof()
    {
        return $this->belongsTo(matiere_prof::class);
    }

    public function eleves()
    {
        return $this->belongsToMany(Eleve::class);
    }
}
