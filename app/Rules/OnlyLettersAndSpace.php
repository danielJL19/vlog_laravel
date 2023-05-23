<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class OnlyLettersAndSpace implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $exp="/^[a-zA-Z\sñáéíóúÁÉÍÓÚ]+$/";
        //validacion
        if (!preg_match($exp,$value)) {
            $fail('Esto no contiene letras');
        }
    }
}
