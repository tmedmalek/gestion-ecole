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
        return $this->belongsToMany(matiere::class, 'matiere_prof');
    }

    public function classes()
    {
        return $this->belongsToMany(classe::class, 'classes_profs');
    }

    public function userparents()
    {
        return $this->belongsToMany(UserParent::class, 'appointment');
    }
}
