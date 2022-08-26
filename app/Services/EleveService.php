<?php

namespace App\Services;

use App\Models\Eleve;

/**
 * Class EleveService.
 */
class EleveService
{
    public function store($data)
    {
        $eleve = Eleve::firstWhere('first_name', $data['first_name']);

        if (isset($eleve)) {
            return null;
        }

        $eleve = Eleve::create($data);
        return $eleve;
    }

    public function update($data, $id)
    {
        $eleve = Eleve::where('id', $id)->first();
        if (is_null($eleve)) {
            return null;
        }

        $eleve_by_name = Eleve::where('first_name', $data['first_name'])->first();
        if (isset($eleve_by_name) && $eleve_by_name->id !== $eleve->id) {
            return response(['success' => -2, 'message' => 'name existe'], 200);
        }

        $eleve->update($data);
        return $eleve;
    }

}
