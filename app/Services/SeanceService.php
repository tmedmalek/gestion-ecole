<?php

namespace App\Services;

use App\Models\MatiereProf;
use App\Models\Professeur;
use App\Models\Salle;
use App\Models\Seance;
use App\Traits\TimeRangeTrait;
use Illuminate\Support\Collection;

/**
 * Class SeanceService.
 */
class SeanceService
{
   use TimeRangeTrait;
   public function getMatiereProf($mat_id)
   {
      $mat_prof = MatiereProf::where('matiere_id', $mat_id)->first();
      if (isset($mat_prof)) {
         return $mat_prof;
      }
      return null;
   }


   public function getSeance($id)
   {
      $seance = Seance::find($id);
      if (isset($seance)) {
         return $seance;
      }
      return null;
   }

   public function getMatiere($classe)
   {

      $collection = new Collection();
      foreach ($classe->niveau->matieres as $matiere) {
         $collection->push([
            'id' => $matiere->id,  'name' => $matiere->name, 'nb_H' => $matiere->pivot->nb_heure_semaine
         ]);
      }
      return $collection;
   }


   public function getProf($id)
   {
      $prof = Professeur::find($id);
      if (isset($prof)) {
         return $prof;
      }
   }


   public function  checkSalleJourTime($salle, $start, $end, $day)
   {
      $seance = Seance::where('heure_debut', $start)
         ->where('heure_fin', $end)
         ->where('jour_seance', $day)
         ->where('salle_id', $salle)
         ->first();
      if (isset($seance)) {
         return $seance;
      }
      return null;
   }


   public function checkProfJourTime($prof, $start, $end, $day)
   {
      $profMat = MatiereProf::where('professeur_id', $prof)->first();
      $seance = Seance::where('heure_debut', $start)
         ->where('heure_fin', $end)
         ->where('jour_seance', $day)
         ->where('matiere_prof_id', $profMat->id)
         ->first();
      if (isset($seance)) {
         return $seance;
      }
      return null;
   }


   public function getSalle($start, $end, $day)
   {
      $id = 1;
      do {

         $salle = Salle::find($id);
         $seance = $this->checkSalleJourTime($salle->id, $start, $end, $day);
         $id++;
      } while (isset($seance));
      return $salle;
   }

   public function genereteCalendrierData($classes, $weekDays)
   {
      $times = $this->generateTimeRange(config('app.calendrier.start_time'), config('app.calendrier.end_time'));
      foreach ($classes as $classe) {
         $collection = $this->getMatiere($classe);
         foreach ($times as $time) {
            foreach ($weekDays as $index => $day) {
               $matiere = $collection->firstWhere('nb_H', !0);
               if (isset($matiere)) {
                  $mat_prof = $this->getMatiereProf($matiere['id']);
                  $salle = $this->getSalle($time['start'], $time['end'], $index);
                  $seance =  $this->checkProfJourTime($mat_prof->professeur_id, $time['start'], $time['end'], $index);
                  if (is_null($seance)) {
                     $collection = $collection->map(function ($item, $index) use ($matiere) {
                        if ($item['name'] == $matiere['name']) {
                           $item['nb_H'] =  $item['nb_H'] - 2;
                        }
                        return $item;
                     });
                     $profeseur = $this->getProf($mat_prof->professeur_id);
                     $seance = new Seance();
                     $seance->classe()->associate($classe->id);
                     $seance->matiereProf()->associate($mat_prof->id);
                     $seance->salle()->associate($salle->id);
                     $seance->professeur = $profeseur->first_name . ' ' . $profeseur->last_name;
                     $seance->matiere = $matiere['name'];
                     $seance->heure_debut = $time['start'];
                     $seance->heure_fin = $time['end'];
                     $seance->jour_seance = $index;
                     $seance->save();
                  }
               }
            }
         }
      }
   }
}
