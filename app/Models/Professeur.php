<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Parental\HasParent;

class Professeur extends User
{
    use HasParent;
    use HasFactory;


    public function matieres()
    {
        return $this->belongsToMany(Matiere::class, 'matiere_prof', 'professeur_id', 'matiere_id');
    }


    public function admin()
    {
        return $this->belongsTo(Admin::class, 'matiere_prof');
    }


    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'classes_profs', 'professeur_id', 'classe_id');
    }


    public function userparents()
    {
        return $this->belongsToMany(UserParent::class, 'appointment', 'professeur_id', 'userparent_id');
    }
}
