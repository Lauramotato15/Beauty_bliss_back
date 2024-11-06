<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;

trait HasJsonError
{
    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
