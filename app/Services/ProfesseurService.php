<?php

namespace App\Services;

use App\Models\Professeur;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class ProfesseurService
{
    public function store($data)
    {
        $professeur = Professeur::firstWhere('email', $data['email']);

        if (is_null($professeur)) {

            $data['password'] = bcrypt($data['password']);
            return    $professeur = Professeur::create($data);
        }
        return null;
    }
}
