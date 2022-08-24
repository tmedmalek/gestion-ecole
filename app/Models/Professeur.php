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
        return $this->belongsToMany(Matiere::class, 'matiere_prof');
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'matiere_prof');
    }

    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'classes_profs');
    }

    public function userparents()
    {
        return $this->belongsToMany(UserParent::class, 'appointment');
    }
}
