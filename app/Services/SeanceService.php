<?php

namespace App\Services;

use App\Models\Classe;
use App\Models\MatiereProf;
use App\Models\Salle;
use App\Models\Seance;
use Carbon\Carbon;

/**
 * Class SeanceService.
 */
class SeanceService
{
   public function checkClasseExiste($id)
   {
      $classe = Classe::find($id);
      if (isset($classe)) {
         return $classe;
      }
      return null;
   }


   public function getMatiereProf($pro_id,$mat_id)
   {
      $mat_prof = MatiereProf::where('professeur_id',$pro_id)->where('matiere_id',$mat_id)->first();
      if (isset($mat_prof)) {
         return $mat_prof;
      }
      return null;
   }


   public function checkSaleExiste($id)
   {
      $salle = Salle::find($id);
      if (isset($salle)) {
         return $salle;
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
  
   public function    checkprofjourtime(){

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
