<?php

namespace App\Services;

use App\Models\Classe;
use App\Models\Professeur;

class ProfesseurService
{
    public function store($data)
    {
        $classe = Classe::firstWhere('id', $data['classe_id']);
        if (is_null($classe)) {
            return null;
        }
        $professeur = Professeur::firstWhere('email', $data['email']);

        if (is_null($professeur)) {
            $data['password'] = bcrypt($data['password']);
                $professeur = Professeur::create($data);
                $professeur->classes()->attach($classe);
                return  $professeur;
        }
        return null;
    }

    public function update($data, $id)
    {
        $Professeur = Professeur::where('id', $id)->first();
        if (is_null($Professeur)) {
            return null;
        }
        $classe = Classe::firstWhere('id', $data['classe_id']);
        if (is_null($classe)) {
            return null;
        }

        $Professeur = Professeur::where('email', $data['email'])->first();
        if (isset($Professeur) && $Professeur->id !== $Professeur->id) {
            return null;
        }
        $Professeur->update($data);
        $Professeur->classes()->attach($classe);
        return $Professeur;
    }
}
