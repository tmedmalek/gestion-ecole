<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\Matiere;

/**
 * Class MatiereService.
 */
class MatiereService
{
    public function store($data)
    {

        $this->checkMatiereNotEXiste($data);
        $matiere = Matiere::create($data);
        return $matiere;
    }


    public function update($data, $id)
    {
        $this->checkMatiereEXiste($data, $id);
        $matiere = $this->getMatiere($id);
        $matiere->update($data);
        return $matiere;
    }


    public function checkMatiereNotEXiste($data)
    {
        $matiere = Matiere::where(['name' => $data['name'], 'niveau' => $data['niveau']]);
        if (isset($matiere)) {
            throw new NotFoundException(['note' => -1, 'message' => 'matiere existe']);
        }
    }


    public function checkMatiereEXiste($data, $id)
    {
        $matiere = Matiere::where(['name' => $data['name'], 'niveau' => $data['niveau']]);
        if (isset($matiere) && $id != $matiere->id) {
            throw new NotFoundException(['note' => -1, 'message' => 'matiere existe']);
        }
    }


    public function getMatiere($id)
    {
        $matiere = Matiere::where('id', $id)->first();
        if (is_null($matiere)) {
            throw new NotFoundException(['note' => -1, 'message' => 'matiere not found']);
        }
        return $matiere;
    }
}
