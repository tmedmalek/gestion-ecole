<?php

namespace App\Rules;

use App\Models\Seance;
use Illuminate\Contracts\Validation\Rule;

class SeanceAvailabilityRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($lesson = null)
    {
        $this->lesson = $lesson;
    }

    /**
     * 
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Seance::isTimeAvailable(
            request()->input('jour_seance'),
            $value,
            request()->input('heure_debut'),
            request()->input('heure_fin'),
            request()->input('classe_id'),
            request()->input('matiere_prof_id'),
            request()->input('salle_id'),
            $this->lesson
        );
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
