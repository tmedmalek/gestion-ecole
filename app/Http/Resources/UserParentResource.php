<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserParentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {  return[
        'first_name'=>$this->first_name,
        'last_name'=>$this->last_name,
        'date_naissance'=>$this->date_naissance,
        'type'=>$this->type,
        'email'=>$this->email,
        'password'=>$this->password,
        'mobile'=>$this->mobile,
        'adresse'=>$this->adresse,
        'cin'=>$this->cin,
        'street'=>$this->street,
        'city'=>$this->city,
        'gouverneant'=>$this->gouverneant,
        'zipcode'=>$this->zipcode,
        // 'eleves'=> new EleveResourceCollection($this->eleves)

    ];
    }
}
