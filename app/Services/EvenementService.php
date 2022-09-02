<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\Evenement;

/**
 * Class EvenementService.
 */
class EvenementService
{
   public function store($data)
   {
      $this->checkEventNotExiste($data['name']);
      $event = Evenement::create($data);
      return $event;
   }


   public function checkEventNotExiste($name)
   {
      $event = Evenement::firstwhere('name', $name);
      if (isset($event)) {
         throw new NotFoundException(['code' => '-1', 'message' => 'evenement is existe']);
      }
   }


   public function update($data, $id)
   {
      $event = $this->getEvent($id);
      $this->checkNameNotExiste($data['name'], $id);
      $event->update($data);
   }


   public function getEvent($id)
   {
      $event = Evenement::find($id);
      if (is_null($event)) {
         throw new NotFoundException(['code' => -1, 'message' => ' event not found']);
      }
      return $event;
   }


   public function checkNameNotExiste($name, $id)
   {
      $event = Evenement::firstWhere('name', $name);
      if (isset($event) && $id != $event->id) {
         throw new NotFoundException(['code' => '-3', 'message' => 'evenement is existe']);
      }
   }
}
