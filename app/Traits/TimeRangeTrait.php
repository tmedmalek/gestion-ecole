<?php

namespace App\Traits;

use Carbon\Carbon;

/**
 * Class TimeRangeTrait.
 */
trait TimeRangeTrait
{
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