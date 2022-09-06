<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\MatiereNiveau;

/**
 * Class MatiereNiveauService.
 */
class MatiereNiveauService
{
   public function update($data, $id)
   {
      $matniveau = $this->getMatniveau($id);
      $matniveau->update($data);
      return $matniveau;
   }


   public function getMatniveau($id)
   {
      $matniveau = MatiereNiveau::find($id);
      if (is_null($matniveau)) {
         throw new NotFoundException(['code' => -1, 'message' => 'matierniveau not found']);
      }
      return $matniveau;
   }
}
