<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\Classe;
use App\Models\Eleve;
use App\Models\UserParent;
use phpDocumentor\Reflection\Types\Parent_;

/**
 * Class EleveService.
 */
class EleveService
{

    public function store($data)
    {
        $this->eleveExiste($data);
        $classe = $this->classeExiste($data);
        $parent = $this->parentExiste($data);
        //return $parent->id;
        $eleve = Eleve::create($data);
        $eleve->classe()->associate($classe->id);
        $eleve->userParent()->associate($parent->id)->save();
        return $eleve;
    }


    public function update($data, $id)
    {
        $this->eleveNOtExiste($id);
        $classe = $this->classeExiste($data);
        $parent = $this->parentExiste($data);
        $eleve = $this->getEleve($id);
        $eleve->update($data);
        $eleve->classe()->associate($classe->id);
        $eleve->userParent()->associate($parent->id);
        return $eleve;
    }


    public function getEleve($id)
    {
        $eleve = Eleve::firstWhere('id', $id);
        if (is_null($eleve)) {
            throw new NotFoundException(['code' => -1, 'message' => ' eleve not found']);
        }
        return $eleve;
    }


    public function parentExiste($data)
    {
        $parent = UserParent::firstwhere('cin', $data['parent_cin']);
        if (is_null($parent)) {
            throw new NotFoundException(['code' => -1, 'message' => ' parent not found ']);
        }
        return $parent;
    }


    public function classeExiste($data)
    {
        $classe = Classe::firstwhere('id', $data['classe_id']);
        if (is_null($classe)) {
            throw new NotFoundException(['code' => -1, 'message' => ' classe not found ']);
        }
        return $classe;
    }


    public function eleveExiste($data)
    {
        $eleve = Eleve::firstWhere('matricule', $data['matricule']);

        if (isset($eleve)) {
            throw new NotFoundException(['code' => -1, 'message' => ' eleve existe']);
        }
    }


    public function eleveNOtExiste($id)
    {
        $eleve = Eleve::firstWhere('id', $id);

        if (is_null($eleve)) {
            throw new NotFoundException(['code' => -1, 'message' => ' eleve not found']);
        }
        return $eleve;
    }
}
