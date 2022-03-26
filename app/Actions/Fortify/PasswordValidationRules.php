<?php

namespace App\Actions\Fortify;

use Illuminate\Validation\Rule;
use Laravel\Fortify\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array
     */
    protected function passwordRules(): array
    {
        return ['required', 'string', new Password, 'confirmed'];
    }
}
