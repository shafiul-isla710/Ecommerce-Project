<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ApiFormValidationRequest;

class AddCartListRequest extends ApiFormValidationRequest
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
            'product_id'=>'required|exists:products,id',
            'quantity'=>'required|numeric|min:1',
            'color'=>'nullable',
            'size'=>'nullable',
        ];
    }
}
