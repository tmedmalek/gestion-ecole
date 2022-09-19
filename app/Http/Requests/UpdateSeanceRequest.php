<?php

namespace App\Http\Requests;

use App\Rules\SeanceAvailabilityRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSeanceRequest extends FormRequest
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
            'classe_id' => [
                'required',
                'integer'
            ],
            'matiere_prof_id' => [
                'required',
                'integer'
            ],
            'salle_id' => [
                'required',
                'integer'
            ],
            'jour_seance' => [
                'required',
                'integer',
                'min:1',
                'max:6'
            ],
            'heure_debut' => [
                'required',
                new SeanceAvailabilityRule(),
                'date_format:' . config('panel.lesson_time_format')
            ],
            'heure_fin' => [
                'required',
                'after:heure_debut',
                'date_format:' . config('panel.lesson_time_format')
            ],
        ];
    }
}
