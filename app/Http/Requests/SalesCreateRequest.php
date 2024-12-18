<?php

namespace App\Http\Requests;

use App\Traits\HasJsonError;
use Illuminate\Foundation\Http\FormRequest;

class SalesCreateRequest extends FormRequest
{
    use HasJsonError;
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
            'total_value' =>'required|numeric',
            'products' => 'array | required | min:1',
            'products.*.id_product' => 'required|exists:products,id', 
            'products.*.quantity' => 'required|numeric', 
            "products.*.total_value" => 'required|numeric',
        ];
    }
}
