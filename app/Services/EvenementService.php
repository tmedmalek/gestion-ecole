<?php

namespace App\Services;

use App\Models\Evenement;

/**
 * Class EvenementService.
 */
class EvenementService
{
   public function store($data)
   {
      $event = Evenement::create($data);
      return $event;
   }


   public function checkEventNotExiste($name)
   {
      $event = Evenement::firstwhere('name', $name);
      if (isset($event)) {
         return $event;
      }
      return null;
   }


   public function getEvent($id)
   {
      $event = Evenement::find($id);
      if (is_null($event)) {
         return null;
      }
      return $event;
   }


   public function checkNameNotExiste($name, $id)
   {
      $event = Evenement::firstWhere('name', $name);
      if (isset($event) && $id != $event->id) {
         return $event;
      }
      return null;
   }
}
