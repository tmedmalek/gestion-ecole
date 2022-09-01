<?php

namespace App\Traits;

use App\Models\Matiere;

/**
 * Class MatiereTrait.
 */
trait MatiereTrait
{
    public function setMatiers($professeur, $matieres)
    {
        if (isset($matieres[0])) {
            $matiere = Matiere::whereIn('id', $matieres)->get();
            $professeur->matieres()->sync($matiere);
        }
    }
}
