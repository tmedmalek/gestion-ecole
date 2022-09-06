<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\Note;

/**
 * Class NoteService.
 */
class NoteService
{
   public function update($data, $id)
   {
      $note = $this->getNote($id);
      $note->update($data);
      return $note;
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
