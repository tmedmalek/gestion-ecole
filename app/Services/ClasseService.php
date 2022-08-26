<?php

namespace App\Services;

use App\Models\Classe;

/**
 * Class ClasseService.
 */
class ClasseService
{
    public function store($data)
    {
        $clase = Classe::firstWhere('name', $data['name']);

        if (isset($clase)) {
            return null;
        }

        $clase = Classe::create($data);
        return $clase;
    }

    public function update($data, $id)
    {
        $classe = Classe::where('id', $id)->first();
        if (is_null($classe)) {
            return null;
        }

        $classe_by_name = Classe::where('first_name', $data['first_name'])->first();
        if (isset($classe_by_name) && $classe_by_name->id !== $classe->id) {
            return response(['success' => -2, 'message' => 'name existe'], 200);
        }

        $classe->update($data);
        return $classe;
    }
}
