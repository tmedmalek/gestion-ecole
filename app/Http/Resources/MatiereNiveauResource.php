<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MatiereNiveauResource extends JsonResource
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
            'id' => $this->id,
            'niveau_id' => $this->niveau_id,
            'matiere_id' => $this->matiere_id,
            'nb_heure_semaine' => $this->nb_heure_semaine
        ];
    }
}
