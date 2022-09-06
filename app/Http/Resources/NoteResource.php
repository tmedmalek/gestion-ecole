<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
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
            'note' => $this->note,
            'eleve_id' => $this->eleve_id,
            'matiere_id' => $this->matiere_id,
            'bulletin_id' => $this->bulletin_id,
            'trimestre_id' => $this->trimestre_id,

        ];
    }
}
