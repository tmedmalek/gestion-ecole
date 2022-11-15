<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EleveResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'date_naissance' => $this->date_naissance,
            'type' => $this->type,
            'classe_id' => $this->classe_id,
            'parent_id' => $this->parent_id,
            // 'evenements' => new EvenementResourceCollection($this->evenements)
        ];
    }
}
