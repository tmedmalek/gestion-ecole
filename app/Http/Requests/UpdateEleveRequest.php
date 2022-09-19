<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEleveRequest extends FormRequest
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
            'matricule' => 'integer|nullable',
            'classe_id' => 'integer|nullable',
            'parent_cin' => 'integer|nullable',
            'evenements'=>'array|nullable',
            'evenements.*' => 'numeric',
        ];
    }
}
