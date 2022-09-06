<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    use HasFactory;

    protected $fillable = [
        'niveau_scolaire',
        'nb_heure_semaine'
    ];
    

    public function matieres()
    {
        return $this->belongsToMany(Matiere::class, 'niveau_matiere','matiere_id','niveau_id');
    }


   

}
