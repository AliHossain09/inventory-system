<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        'name' => 'required|string|max:255',
        'sku' => 'required|unique:products,sku,' . $this->route('product')->id,
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'description' => 'nullable',
        'image' => 'nullable|image|max:5120',
    ];

    }
}
