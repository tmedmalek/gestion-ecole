<?php

namespace App\Services;

use App\Models\Matiere;
use App\Models\Professeur;

class ProfesseurService
{


    public function checkMatiresExiste($matieres)
    {
        $matiere = Matiere::whereIn('id', $matieres)->get();
        if (is_null($matiere)) {
            return null;
        }
        return $matiere;
    }

    public function checkProfNotExiste($column, $value)
    {
        $professeur = Professeur::firstWhere($column, $value);
        if (isset($professeur)) {
            return $professeur;
        }
        return null;
    }

    public function getProf($id)
    {
        $professeur = Professeur::where('id', $id)->first();
        if (is_null($professeur)) {
            return null;
        }
        return $professeur;
    }


    public function checkEmailUnique($email, $id)
    {
        $professeur = Professeur::where('email', $email)->first();
        if (isset($professeur) && $id != $professeur->id) {
            return null;
        }
        return $professeur;
    }

    public function checkCinUnique($cin, $id)
    {
        $professeur = Professeur::where('cin', $cin)->first();
        if (isset($professeur) && $id != $professeur->id) {
            return null;
        }
        return $professeur;
    }
}
