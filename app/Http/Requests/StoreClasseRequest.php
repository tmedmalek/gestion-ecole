<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClasseRequest extends FormRequest
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
            'name' => 'required|string|min:5|max:30',
            'niveau_scolaire' => 'required|string|min:5|max:30',
            'debut_annee_scolaire' => 'required|date',
            'fin_annee_scolaire' => 'required|date'
        ];
    }
}
