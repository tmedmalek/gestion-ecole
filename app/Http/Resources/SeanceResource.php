<?php

namespace App\Http\Resources;

use App\Models\Matiere;
use Illuminate\Http\Resources\Json\JsonResource;

class SeanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [

            'date_seance' => $this->date_seance,
            'heure' => [
                'heure_debut' => $this->heure_debut,
                'heure_fin' => $this->heure_fin,
            ],
            'jour_seance' => $this->jour_seance,
            'classe' => $this->classe->name,
            'matiere' => $this->matiere,
            'professeur' => $this->professeur,
            'salle' => $this->salle->numero,
        ];
    }
}
