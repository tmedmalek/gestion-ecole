<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seance extends Model
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
        return $this->belongsTo(Classe::class);
    }

    
    public function salle()
    {
        return $this->belongsTo(Salle::class);
    }


    public function matiere_prof()
    {
        return $this->belongsTo(MatiereProf::class);
    }


    public function eleves()
    {
        return $this->belongsToMany(Eleve::class, 'absence', 'seance_id', 'eleve_id');
    }
}
