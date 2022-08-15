<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserParentRequest extends FormRequest
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
            'dob' => 'required|date',
            'email' => 'required|email',
            'password' => 'required',
            'mobile' => 'required|numeric|digits:8',
            'street' => 'required|min:5|max:30|string',
            'cin' => 'required|numeric|digits:8',
            'city' => 'required|min:5|max:30',
            'zipcode' => 'required',
            'gouverneant' => [
                'required',
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
