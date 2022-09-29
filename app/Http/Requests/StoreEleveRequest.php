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
            'users' => 'array',
            'users.*.first_name' => 'required|min:5|max:30|string',
            'users.*.last_name' => 'required|min:5|max:30|string',
            'users.*.date_naissance' => 'required|date',
            'users.*.matricule' => 'required',
            'users.*.classe_id' => 'required',
            'users.*.parent_cin' => 'required',
        ];
    }
}
