<?php

namespace App\Services;

use App\Models\Seance;
use App\Traits\TimeRangeTrait;

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
}
