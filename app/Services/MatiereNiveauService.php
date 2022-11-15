<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\MatiereNiveau;

/**
 * Class MatiereNiveauService.
 */
class MatiereNiveauService
{
   public function update($data, $MatiereNiveau)
   {
      $MatiereNiveau->update($data);
      return $MatiereNiveau;
   }
}
