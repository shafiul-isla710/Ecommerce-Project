<?php

namespace App\Http\Requests;

use App\Helper\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiFormValidationRequest extends FormRequest
{
   //apiResponse traits
   use ApiResponse;

   protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->error($validator->errors()->all(),422));
    }
}
