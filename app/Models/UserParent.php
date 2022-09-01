<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Parental\HasParent;

class UserParent extends User
{
    use HasFactory;
    use HasParent;


    public function eleves()
    {
        return $this->hasMany(Eleve::class,'eleve_id');
    }


    public function professers()
    {
        return $this->belongsToMany(Professeur::class, 'appointment', 'userparent_id', 'professeur_id');
    }
}
