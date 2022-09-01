<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEleveRequest extends FormRequest
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
            'first_name' => 'required|min:5|max:30|string',
            'last_name' => 'required|min:5|max:30|string',
            'date_naissance' => 'required|date',
            'matricule' => 'required',
            'classe_id' => 'required',
            'parent_cin' => 'required',
        ];
    }
}
