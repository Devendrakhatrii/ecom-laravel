<?php

namespace App\Http\Requests;

use App\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreProductRequest extends FormRequest
{
    use ApiResponse;
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
        return
            [
                'name' => ['required', 'max:255'],
                'description' => ['required', 'max:256'],
                'price' => ['required', 'numeric', 'gt:0'],
                'quantity' => ['required', 'numeric', 'gt:0'],
                'type' => ['required', 'in:physical,digital'],
            ];
    }
    public function failedValidation(Validator $validator)
    {

        throw new HttpResponseException(
            $this->validationFails($validator->errors()->toArray())
        );
    }
}
