<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class matiere extends Model
{

    use HasFactory;
    protected $fillable = [
        'name',

    ];
    
    public function eleves()
    {
        return $this->belongsToMany(Eleve::class,'notes');
    }

    public function professeurs()
    {
        return $this->belongsToMany(Professeur::class,'matiere_prof');
    }

}
