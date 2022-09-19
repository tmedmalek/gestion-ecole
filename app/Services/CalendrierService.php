<?php

namespace App\Services;

use App\Models\Seance;
use Illuminate\Support\Carbon;

/**
 * Class CalendrierService.
 */
class CalendrierService
{
   public function generateCalendarData($weekDays, $classe_id)
   {

      $calendarData = [];

      $timeRange = $this->generateTimeRange(config('app.calendrier.start_time'), config('app.calendrier.end_time'));

      $lessons = Seance::with('classe', 'matiereProf', 'salle')->where('classe_id', $classe_id)->first();
      if (is_null($lessons)) {
         return response(['success' => -1, 'message' => 'classse not found'], 200);
      }

      foreach ($timeRange as $time) {
         $timeText = $time['start'] . ' - ' . $time['end'];
         $calendarData[$timeText] = [];


         foreach ($weekDays as $index => $day) {
          
            $lesson = $lessons->where('jour_seance', $index)->where('heure_debut', $time['start'])->first();
            if ($lesson) {
               $calendarData[$timeText][] = [
                  'classe' => $lessons->classe->name,
                  'professeur' => $lessons->matiereProf->professeur->first_name . ' ' . $lessons->matiereProf->professeur->last_name,
                  'salle' => $lessons->salle->numero,
                  'matiere' => $lessons->matiereProf->matiere->name,
               ];
            } else if (!$lessons->where('jour_seance', $index)->where('heure_debut', '<', $time['start'])->where('heure_fin', '>=', $time['end'])->count()) {
               array_push($calendarData[$timeText], 1);
            } else {
               array_push($calendarData[$timeText], 0);
            }
         }
      }


      return $calendarData;
   }



   public function generateTimeRange($from, $to)
   {
      $time = Carbon::parse($from);
      $timeRange[] = [
         'start' => $time->format("H:i"),
         'end' => $time->addMinutes(120)->format("H:i")
      ];
      do {
         $timeRange[] = [
            'start' => $time->format("H:i"),
            'end' => $time->addMinutes(120)->format("H:i")
         ];
      } while ($time->format("H:i") !== $to);
      return $timeRange;
   }
}
