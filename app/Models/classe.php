<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classe extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'niveau_scolaire',
        'debut_annee_scolaire',
        'fin_annee_scolaire',
    ];
    public function Eleves()
    {
        return $this->hasMany(Eleve::class);
    }
    public function Seances()
    {
        return $this->hasMany(seance::class);
    }
    public function Professeurs()
    {
        return $this->belongsToMany(Professeur::class, 'clases_profs');
    }
}
