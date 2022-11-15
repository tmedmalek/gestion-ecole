<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trimestre extends Model
{
    use HasFactory;

    protected $fillable = [
        'annee_scolaire',
    ];

    public function eleves()
    {
        return $this->belongsToMany(Eleve::class, 'frais_scolaire','trimeste_id','eleve_id');
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
