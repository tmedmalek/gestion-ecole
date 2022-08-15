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
            'id'=>$this->id,
            'fist_name'=>$this->fist_name,
            'last_name'=>$this->last_name,
            'dob'=>$this->dob,
            'type'=>$this->type,
        ];
    }
}
