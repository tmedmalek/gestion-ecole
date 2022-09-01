<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',

    ];


    public function eleves()
    {
        return $this->belongsToMany(Eleve::class, 'notes', 'matiere_id', 'note_id');
    }


    public function professeurs()
    {
        return $this->belongsToMany(Professeur::class, 'matiere_prof', 'matiere_id', 'professeur_id');
    }
}
