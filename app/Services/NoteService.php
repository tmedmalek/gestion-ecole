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

   public function store($data)
   {
      $matiere = $this->getMatiere($data['matiere_id']);
      $eleve = $this->getEleve($data['eleve_id']);
      $note = Note::create($data);
      $note->matiere()->associate($matiere->id);
      $note->eleve()->associate($eleve->id)->save();
      return $note;
   }


   public function update($data, $id)
   {
      $note = $this->getNote($id);
      $note->update($data);
      return $note;
   }


   public function getMatiere($id)
   {
      $matiere = Matiere::find($id);
      if (is_null($matiere)) {
         throw new NotFoundException(['code' => -1, 'message' => 'matiere not found']);
      }
      return $matiere;
   }


   public function getEleve($id)
   {

      $eleve = Eleve::find($id);
      if (is_null($eleve)) {
         throw new NotFoundException(['code' => -1, 'message' => 'eleve not found']);
      }
      return $eleve;
   }


   public function getNote($id)
   {
      $note = Note::find($id);
      if (is_null($note)) {
         throw new NotFoundException(['code' => -1, 'message' => 'note not found']);
      }
      return $note;
   }
}
