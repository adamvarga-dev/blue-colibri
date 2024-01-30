<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckAmount implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(array_sum($value) > 200000) {
            switch ($attribute) {
                case 'first':
                    $fail('Szálláshely nem lehet nagyobb mint 200.000 Ft!');
                    break;
                case 'second':
                    $fail('Vendéglátás nem lehet nagyobb mint 200.000 Ft!');
                    break;    
                default:
                    $fail('Szabadidő nem lehet nagyobb mint 200.000 Ft!');
                    break;
            }
        }
    }
}
