<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatiereProf extends Model
{
    use HasFactory;
    protected $fillable = [
        'professeur_id',
        'matiere_id',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'matiere_prof';


    public function seances()
    {
        return $this->hasMany(Seance::class,'matiere_prof_id');
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    public function professeur()
    {
        return $this->belongsTo(Professeur::class);
    }


}
