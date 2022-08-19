<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Parental\HasParent;

class Eleve extends User
{
    use HasParent;
    use HasFactory;

    public function classe()
    {
        return $this->belongsTo(classe::class);
    }

    public function userparent()
    {
        return $this->belongsTo(UserParent::class);
    }

    public function evenements()
    {
        return $this->belongsToMany(evenement::class, 'participations');
    }

    public function matieres()
    {
        return $this->belongsToMany(matiere::class, 'notes');
    }

    public function seances()
    {
        return $this->belongsToMany(seance::class, 'absence');
    }

    public function trimestes()
    {
        return $this->belongsToMany(trimestre::class, 'frais_scolaire');
    }
}
