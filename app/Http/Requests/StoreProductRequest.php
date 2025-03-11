<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'quantity'    => 'required|integer|min:0',
            'description' => 'required|string|max:255',
            'category'    => 'required|string|max:60',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    /**
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required'        => 'O campo nome é obrigatório.',
            'name.string'          => 'O nome deve ser uma string.',
            'name.max'             => 'O nome não pode ter mais de 255 caracteres.',
            'price.required'       => 'O campo preço é obrigatório.',
            'price.numeric'        => 'O preço deve ser um número.',
            'price.min'            => 'O preço deve ser no mínimo 0.',
            'quantity.required'    => 'O campo quantidade é obrigatório.',
            'quantity.integer'     => 'A quantidade deve ser um número inteiro.',
            'quantity.min'         => 'A quantidade deve ser no mínimo 0.',
            'description.string'   => 'A descrição deve ser uma string.',
            'category.required'    => 'O campo categoria é obrigatório.',
            'category.string'      => 'A categoria deve ser uma string.',
            'category.max'         => 'A categoria não pode ter mais de 255 caracteres.',
            'photo.image' => 'O arquivo deve ser uma imagem.',
            'photo.max' => 'A foto deve ter no máximo 2MB.',
        ];
    }
}
