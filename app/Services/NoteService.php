<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\Eleve;
use App\Models\Matiere;
use App\Models\Note;



/**
 * Class NoteService.
 */
class NoteService
{

   public function getMatiere($id)
   {
      $matiere = Matiere::find($id);
      if (is_null($matiere)) {
         return null;
      }
      return $matiere;
   }


   public function getEleve($id)
   {

      $eleve = Eleve::find($id);
      if (is_null($eleve)) {
         return null;
      }
      return $eleve;
   }


   public function getNote($id)
   {
      $note = Note::find($id);
      if (is_null($note)) {
         return null;
      }
      return $note;
   }
}
