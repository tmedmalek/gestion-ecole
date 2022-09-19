<?php

namespace App\Services;

use App\Models\Matiere;
use App\Models\Niveau;

/**
 * Class MatiereService.
 */
class MatiereService
{
    public function store($data)
    {
        return Matiere::create($data);
    }


    public function update($matiere, $data)
    {
        $matiere->update($data);
        return $matiere;
    }


    public function setniveau($matiere, $niveaux)
    {
        if (isset($niveaux)) {
            $niveau = Niveau::whereIn('id', $niveaux)->get();
            $matiere->niveaux()->sync($niveau);
        }
    }


    public function checkNiveauExiste($niveaux)
    {
        $niveaux = Niveau::whereIn('id', $niveaux)->get();
        if (is_null($niveaux)) {
            return null;
        }
        return $niveaux;
    }


    public function checkMatiereNotEXiste($data)
    {
        $matiere = Matiere::firstWhere('name', $data);
        if (isset($matiere)) {
            return $matiere;
        }
        return null;
    }


    public function checkMatiereEXiste($data, $id)
    {
        $matiere = Matiere::firstWhere('name', $data);
        if (isset($matiere) && $id != $matiere->id) {
            return null;
        }
        return $matiere;
    }


    public function getMatiere($id)
    {
        $matiere = Matiere::where('id', $id)->first();
        if (is_null($matiere)) {
            return false;
        }
        return $matiere;
    }
}
