<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEvenementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
        'name'=>'string|required',
        'type'=>'string|required',
        'adresse'=>'string|required',
        'date'=>'date|required',
        'heure_debut'=>'',
        'heure_fin'=>'',
        'nb_places'=>'numeric'
        ];
    }

}
