<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\Classe;
use App\Models\Niveau;

/**
 * Class ClasseService.
 */
class ClasseService
{
    public function store($data)
    {
        $this->checkniveauexiste($data['niveau_id']);
        $this->checkClasseNameExiste($data);
        $clase = Classe::create($data);
        return $clase;
    }


    public function update($data, $id)
    {
        $classe = $this->checkClasseNotExiste($id);
        $this->checkniveauexiste($data['niveau_id']);
        $this->checkClasseNameExiste($data);
        $classe->update($data);
        return $classe;
    }


    public function checkClasseNameExiste($data)
    {
        $classe = Classe::firstWhere('name', $data['name']);

        if (isset($classe)) {
            throw new NotFoundException(['code' => -1, 'message' => ' classe existe']);
        }
    }


    public function checkClasseNotExiste($id)
    {
        $classe = Classe::where('id', $id)->first();
        if (is_null($classe)) {
            throw new NotFoundException(['code' => -2, 'message' => ' classe not found']);
        }
        return $classe;
    }


    public function checkniveauexiste($id)
    {
        $niveau = Niveau::find($id);
        if (is_null($niveau)) {
            throw new NotFoundException(['code' => -3, 'message' => ' niveau not found']);
        }
    }
}
