<?php

namespace App\Http\Resources;

use App\Http\Resources\ClasseResource\ClasseResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class NiveauResource extends JsonResource
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
            'niveau_scolaire' => $this->niveau_scolaire,
            'nb_heure_semaine' => $this->nb_heure_semaine,
            'classes' => new ClasseResourceCollection($this->classes)
        ];
    }
}
