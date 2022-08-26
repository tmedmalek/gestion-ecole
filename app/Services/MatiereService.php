<?php

namespace App\Services;

use App\Models\Matiere;

/**
 * Class MatiereService.
 */
class MatiereService
{
    public function store($data)
    {
        $matiere = Matiere::firstWhere('name', $data['name']);

        if (is_null($matiere)) {
            return    $matiere = Matiere::create($data);
        }
        return null;
    }

    public function update($data, $id)
    {
        $matiere = Matiere::where('id', $id)->first();
        if (is_null($matiere)) {
            return null;
        }

        if ($matiere->name == $data['name'] && $matiere->id !== $matiere->id) {
            return null;
        }

        $matiere->update($data);
        return $matiere;
    }
}
