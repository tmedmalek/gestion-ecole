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
        return $this->belongsTo(Classe::class);
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function userparent()
    {
        return $this->belongsTo(UserParent::class);
    }

    public function evenements()
    {
        return $this->belongsToMany(Evenement::class, 'participations');
    }

    public function matieres()
    {
        return $this->belongsToMany(Matiere::class, 'notes');
    }

    public function seances()
    {
        return $this->belongsToMany(Seance::class, 'absence');
    }

    public function trimestes()
    {
        return $this->belongsToMany(Trimestre::class, 'frais_scolaire');
    }
}
