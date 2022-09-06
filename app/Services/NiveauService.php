<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\Niveau;

/**
 * Class NiveauService.
 */
class NiveauService
{

   public function store($data)
   {
      $this->checkNiveauExiste($data['niveau_scolaire']);
      $niveau = Niveau::create($data);
      return $niveau;
   }


   public function update($data, $id)
   {
      $niveau = $this->getNiveau($id);
      $this->checkNiveauNotExiste($data['niveau_scolaire'], $id);
      $niveau->update($data);
   }


   public function checkNiveauExiste($data)
   {
      $niveau = Niveau::fristWhere('niveau_scolaire', $data);
      if (isset($niveau)) {
         throw new NotFoundException(['code' => -1, 'message' => 'niveau is existe']);
      }
   }

   
   public function checkNiveauNotExiste($data, $id)
   {
      $niveau = Niveau::fristWhere('niveau_scolaire', $data);
      if (isset($niveau) && $id != $niveau->id) {
         throw new NotFoundException(['code' => -1, 'message' => 'niveau is existe']);
      }
   }


   public function getNiveau($id)
   {
      $niveau = Niveau::find($id);
      if (is_null($niveau)) {
         throw new NotFoundException(['code' => -2, 'message' => 'niveau not Found']);
      }
      return $niveau;
   }
}
