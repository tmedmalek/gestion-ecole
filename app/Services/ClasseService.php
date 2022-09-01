<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\Classe;

/**
 * Class ClasseService.
 */
class ClasseService
{
    public function store($data)
    {
        $this->checkClasseNameExiste($data);
        $clase = Classe::create($data);
        return $clase;
    }
    
    
    public function update($data, $id)
    {
        $classe = $this->checkClasseNotExiste($id);
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
            throw new NotFoundException(['code' => -1, 'message' => ' classe not found']);
        }
        return $classe;
    }

}
