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
            'id'=>$this->id,
            'note'=>$this->note,
            'eleve' => ['eleve_id' => $this->eleve_id, 'name' => $this->eleve->name],
            'matiere'=>['matiere_id' => $this->matiere_id, 'name' => $this->matiere->name],
            'bulletin_id',
            'trimestre_id',
            
        ];
    }
}
