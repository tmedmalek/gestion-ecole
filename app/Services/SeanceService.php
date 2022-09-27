<?php

namespace App\Services;

use App\Models\Classe;
use App\Models\Matiere;
use App\Models\MatiereProf;
use App\Models\Professeur;
use App\Models\Salle;
use App\Models\Seance;
use App\Traits\TimeRangeTrait;


/**
 * Class SeanceService.
 */
class SeanceService
{
   use TimeRangeTrait;

   public function getSeance($id)
   {
      $seance = Seance::find($id);
      if (isset($seance)) {
         return $seance;
      }
      return null;
   }


   public function checkSeanceNotExiste($data)
   {
      $seance = Seance::where('heure_debut', $data['heure_debut'])
         ->where('heure_fin', $data['heure_fin'])
         ->where('jour_seance', $data['jour_seance'])
         ->where('matiere_prof_id', $data['matiere_prof_id'])
         ->where('salle_id', $data['salle_id'])
         ->first();
      if (isset($seance)) {
         return $seance;
      }
      return null;
   }


   public function getMatProf($id)
   {
      $matProf = MatiereProf::find($id);
      if (isset($matProf)) {
         return $matProf;
      }
      return null;
   }


   public function getProf($id)
   {
      $matProf = $this->getMatProf($id);

      $Prof = Professeur::firstWhere($matProf->professeur_id);
      if (isset($Prof)) {
         return $Prof;
      }
      return null;
   }


   public function getMat($id)
   {
      $matProf = $this->getMatProf($id);

      $Mat = Matiere::firstWhere($matProf->matiere_id);
      if (isset($Mat)) {
         return $Mat;
      }
      return null;
   }


   public function checkProfmatExiste($id)
   {
      $matProf = MatiereProf::find($id);
      if (isset($matProf)) {
         return $matProf;
      }
      return null;
   }
   public function checkClasseExiste($id)
   {
      $classe = Classe::find($id);
      if (isset($classe)) {
         return $classe;
      }
      return null;
   }


   public function checkSalleExiste($id)
   {
      $salle = Salle::find($id);
      if (isset($salle)) {
         return $salle;
      }
      return null;
   }
}
