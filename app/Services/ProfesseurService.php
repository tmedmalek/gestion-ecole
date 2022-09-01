<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\Matiere;
use App\Models\Professeur;
use App\Traits\MatiereTrait;
use Illuminate\Support\Facades\DB;

class ProfesseurService
{
    use MatiereTrait;

    public function store($data)
    {
        $this->checkProfNotExiste('email', $data['email']);
        $this->checkProfNotExiste('cin', $data['cin']);
        $data['password'] = bcrypt($data['password']);
        $professeur = Professeur::create($data);
        $this->setMatiers($professeur, $data['matieres']);
        return $professeur;
    }

    public function update($data, $id)
    {
        $professeur = $this->getProf($id);
        $this->checkEmailUnique($data['email'], $id);
        $this->checkCinUnique('cin', $data['cin']);
        $this->checkMatiresExiste($data['matieres']);
        $professeur->update($data);
        $this->setMatiers($professeur, $data['matieres']);
        return $professeur;
    }

    public function checkMatiresExiste($matieres)
    {
        $mariere = Matiere::whereIn('id', $matieres)->get();
        if (is_null($mariere)) {
            throw new NotFoundException(['code' => -1, 'message' => 'matiere not found']);
        }
    }

    public function checkProfNotExiste($column, $value)
    {
        $professeur = Professeur::firstWhere($column, $value);
        if (isset($professeur)) {
            throw new NotFoundException(['code' => -1, 'message' => $column . ' existe']);
        }
    }

    public function getProf($id)
    {
        $professeur = Professeur::where('id', $id)->first();
        if (is_null($professeur)) {
            throw new NotFoundException(['code' => -1, 'message' => 'Professeur not found']);
        }
        return $professeur;
    }


    public function checkEmailUnique($email, $id)
    {
        $professeur = Professeur::where('email', $email)->first();
        if (isset($professeur) && $id != $professeur->id) {
            throw new NotFoundException(['code' => -2, 'message' => 'Professeur_email existe']);
        }
        return $professeur;
    }

    public function checkCinUnique($cin, $id)
    {
        $professeur = Professeur::where('cin', $cin)->first();
        if (isset($professeur) && $id != $professeur->id) {
            throw new NotFoundException(['code' => -2, 'message' => 'Professeur_cin existe']);
        }
        return $professeur;
    }



    public function destroyMatiere($id)
    {
        $classeProf =  DB::table('matiere_prof')->where('professeur_id', $id)->first();
        if (isset($classeProf)) {
            $classeProf->delete();
        }
    }
}
