<?php

namespace App\Services;


use App\Models\Classe;
use App\Models\Eleve;
use App\Models\Evenement;
use App\Models\UserParent;


/**
 * Class EleveService.
 */
class EleveService
{
    public function EventExiste($data)
    {
        $event = Evenement::firstwhere('id', $data['event_id']);
        if (is_null($event)) {
            return null;
        }
        return $event;
    }



    public function parentExiste($data)
    {
        $parent = UserParent::firstwhere('cin', $data['parent_cin']);
        if (is_null($parent)) {
            return null;
        }
        return $parent;
    }


    public function classeExiste($data)
    {
        $classe = Classe::firstwhere('id', $data['classe_id']);
        if (is_null($classe)) {
            return null;
        }
        return $classe;
    }


    public function eleveExiste($data)
    {
        $eleve = Eleve::firstWhere('matricule', $data['matricule']);

        if (isset($eleve)) {
            return null;
        }
        return $eleve;
    }


    public function eleveNOtExiste($id)
    {
        $eleve = Eleve::find($id);

        if (is_null($eleve)) {
            return null;
        }
        return $eleve;
    }
}
