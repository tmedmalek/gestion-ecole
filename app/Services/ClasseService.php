<?php

namespace App\Services;

use App\Models\Classe;
use App\Models\Niveau;

/**
 * Class ClasseService.
 */
class ClasseService
{
    public function store($data)
    {
        $classe = Classe::create($data);
        $classe->niveau()->associate($data['niveau_id']);
        return $classe;
    }


    public function update($data, $id, $classe)
    {
        $classe->update($data);
        $classe->niveau()->associate($data['niveau_id']);
    }


    public function checkClasseNameExiste($name)
    {
        $classe = Classe::firstWhere('name', $name);

        if (isset($classe)) {
            return $classe;
        }
        return null;
    }

    public function checkClasseNameIDExiste($name, $id)
    {
        $classe = Classe::firstWhere('name', $name);

        if (isset($classe) && $classe->id != $id) {
            return $classe;
        }
        return null;
    }


    public function checkClasseNotExiste($id)
    {
        $classe = Classe::where('id', $id)->first();
        if (is_null($classe)) {
            return null;
        }
        return $classe;
    }


    public function checkniveauexiste($id)
    {
        $niveau = Niveau::find($id);
        if (is_null($niveau)) {
            return null;
        }
        return $niveau;
    }
}
