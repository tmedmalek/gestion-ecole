<?php

namespace App\Services;

use App\Models\MatiereProf;
use App\Models\Professeur;
use App\Models\Salle;
use App\Models\Seance;
use App\Traits\TimeRangeTrait;
use Illuminate\Support\Collection;

/**
 * Class CalendrierService.
 */
class CalendrierService
{
   use TimeRangeTrait;
   public function getCalendarData($weekDays, $classe_id)
   {
      $calendarData = [];

      $timeRange = $this->generateTimeRange(config('app.calendrier.start_time'), config('app.calendrier.end_time'));

      $lessons = Seance::with('classe')->where('classe_id', $classe_id)
         ->get();
      foreach ($timeRange as $time) {
         $timeText = $time['start'] . ' - ' . $time['end'];
         $calendarData[$timeText] = [];

         foreach ($weekDays as $index => $day) {
            $lesson = $lessons->where('jour_seance', $index)->where('heure_debut', $time['start'] . ':00')->first();

            if ($lesson) {
               $calendarData[$timeText][] = [
                  'classe' => $lesson->classe->id,
                  'professeur' => $lesson->matiereProf->professeur->first_name . ' ' . $lesson->matiereProf->professeur->last_name,
                  'salle' => $lesson->salle->numero,
                  'matiere' => $lesson->matiereProf->matiere->name,
               ];
            } else if (!$lessons->where('jour_seance', $index)->where('heure_debut', '<', $time['start'] . ':00')->where('heure_fin', '>=', $time['end'] . ':00')->count()) {
               array_push($calendarData[$timeText], 1);
            } else {
               array_push($calendarData[$timeText], 0);
            }
         }
      }

      return $calendarData;
   }


   public function genereteCalendrierData($classes, $weekDays)
   {
      $times = $this->generateTimeRange(config('app.calendrier.start_time'), config('app.calendrier.end_time'));
      foreach ($classes as $classe) {
         $collection = $this->getMatiere($classe);
         foreach ($times as $time) {
            foreach ($weekDays as $index => $day) {

               // bech nchoufou prof fadhi nas3noulou seance 
               // bech ndourou 3al matieret w kol matiere mazel feha wa9et nchouf l prof mte3ha fadhi walla le ken le nçaydou fi blasa bech ma3adech narj3elha 
               $matiers = [];
               $exite = false;
               $salle = $this->getSalle($time['start'], $time['end'], $index);
               do {
                  $matiere = $collection->whereNotBetween('id', $matiers)->firstWhere('nb_H', !0);
                  if (isset($matiere)) {

                     $mat_prof = $this->getMatiereProf($matiere['id']);
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
                        $exite = true;
                     } else {
                        $matiers[] = $matiere['id'];
                     }
                  } else {
                     $exite = true;
                  }
               } while (!$exite);
            }
         }
      }
   }


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
}
