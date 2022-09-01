<?php

namespace App\Http\Resources\ClasseResource;

use Illuminate\Http\Resources\Json\JsonResource;

class ClasseResource extends JsonResource
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
            'name' => $this->name,
            'eleves' => new ClasseElevesResourceCollection($this->eleves),
            // 'professeurs' => new ProfesseurResourceCollection($this->professeurs),
        ];
    }
}
