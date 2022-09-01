<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfesseurRequest extends FormRequest
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
            'first_name' => 'min:5|max:30|string',
            'last_name' => 'min:5|max:30|string',
            'date_naissance' => 'date',
            'email' => 'email',
            'password' => '',
            'mobile' => 'numeric|digits:8',
            'street' => 'min:5|max:30|string',
            'cin' => 'numeric|digits:8',
            'annee_afectation' => 'date',
            'diplome' => 'min:5|max:30|string',
            'grade' => 'min:5|max:30|string',
            'salaire' => 'numeric',
            'specialite' => 'string|min:5|max:30',
            'city' => 'string|min:5|max:30',
            'zipcode' => '',
            'matieres' => 'array',
            'matieres.*' => 'numeric',
            'gouverneant' => [
                Rule::in([
                    'tunis',
                    'manouba',
                    'arienna',
                    'benarous',
                    'beja',
                    'kef',
                    'jandouba',
                    'seliana',
                    'sidibouzid',
                    'bizert',
                    'mednin',
                ]),
            ],
        ];
    }
}
