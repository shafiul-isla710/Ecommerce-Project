<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ApiFormValidationRequest;

class CustomerCreateRequest extends ApiFormValidationRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'mobile_no'=>'required',
            'city'=>'required',
            'state'=>'required',
            'post_code'=>'required',
            'address'=>'required',

            'cus_fax'=>'required',
            'ship_name'=>'required',
            'ship_add'=>'required',
            'ship_city'=>'required',
            'ship_state'=>'required',
            'ship_postcode'=>'required',
            'ship_country'=>'required',
            'ship_phone'=>'required',
            'ship_fax'=>'required',
        ];
    }
}
