<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\Classe;
use App\Models\Eleve;
use App\Models\Evenement;
use App\Models\UserParent;


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
        $event = $this->EventExiste($data);
        $eleve = $this->getEleve($id);
        $eleve->update($data);
        $eleve->evenement()->sync($event->id);
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

    // public function MatiereExiste($data)
    // {
    //     $matiere = Matiere::firstwhere('id', $data['matiere_id']);
    //     if (is_null($matiere)) {
    //         throw new NotFoundException(['code' => -1, 'message' => ' matiere not found ']);
    //     }
    //     return $matiere;
    // }


    public function EventExiste($data)
    {
        $event = Evenement::firstwhere('id', $data['event_id']);
        if (is_null($event)) {
            throw new NotFoundException(['code' => -1, 'message' => ' event not found ']);
        }
        return $event;
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
