<?php

namespace Modules\Common\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Closure;
use Illuminate\Support\Facades\Validator;

class EmailOrPhoneRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $isEmail = Validator::make(['email_or_phone' => $value], [
            'email_or_phone' => 'email'
        ])->passes();
        $isPhone = Validator::make(['email_or_phone' => $value], [
            'email_or_phone' => 'phone'
        ])->passes();
        if (!$isEmail && !$isPhone) {
            $fail(__('validation.email_or_phone'));
        }
    }
}
