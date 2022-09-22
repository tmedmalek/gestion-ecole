<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Seance extends Model
{
    use HasFactory;


    protected $fillable = [
        'date',
        'jour_seance',
        'date_seance',
        'heure_debut',
        'heure_fin',
        'classe_id',
        'matiere_prof_id',
        'salle_id',
        'matiere',
        'professeur'
    ];

    const WEEK_DAYS = [
        '1' => 'lundi',
        '2' => 'Mardi',
        '3' => 'Mercredi',
        '4' => 'Jeudi',
        '5' => 'Vendredi',
        '6' => 'Samedi',
    ];



    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }


    public function salle()
    {
        return $this->belongsTo(Salle::class);
    }


    public function matiereProf()
    {
        return $this->belongsTo(MatiereProf::class, 'matiere_prof_id');
    }


    public function eleves()
    {
        return $this->belongsToMany(Eleve::class, 'absence', 'seance_id', 'eleve_id');
    }

    public function getDifferenceAttribute()
    {
        return Carbon::parse($this->heure_fin)->diffInMinutes($this->heure_debut);
    }

    public function getStartTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('H:i:s', $value)->format(config('panel.lesson_time_format')) : null;
    }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = $value ? Carbon::createFromFormat(
            config('panel.lesson_time_format'),
            $value
        )->format('H:i:s') : null;
    }

    public function getEndTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('H:i:s', $value)->format(config('panel.lesson_time_format')) : null;
    }

    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = $value ? Carbon::createFromFormat(
            config('panel.lesson_time_format'),
            $value
        )->format('H:i:s') : null;
    }

    public static function isTimeAvailable($jour_seance, $heure_debut, $heure_fin, $classe, $matiere_prof, $salle, $lesson)
    {
        $lessons = self::where('jour_seance', $jour_seance)
            ->when($lesson, function ($query) use ($lesson) {
                $query->where('id', '!=', $lesson);
            })
            ->where(function ($query) use ($classe, $matiere_prof, $salle) {
                $query->where('classe_id', $classe)
                    ->orWhere('matiere_prof_id', $matiere_prof)->orWhere('salle_id', $salle);
            })
            ->where([
                ['heure_debut', '<', $heure_fin],
                ['heure_fin', '>', $heure_debut],
            ])
            ->count();

        return !$lessons;
    }

    public function scopeCalendarByRoleOrClassId($query, $classe_id)
    {
        return $query->where('classe_id', $classe_id);
    }
}
