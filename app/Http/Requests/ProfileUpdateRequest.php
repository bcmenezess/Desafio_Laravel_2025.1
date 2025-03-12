<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $editId = usuarioLogado()->id;

        return [
            //'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:users,email,' . $editId,
                Rule::unique(User::class)->ignore($editId),
            ],
            'name' => 'required|string|max:255',
            //'email' => 'required|email|unique:users,email',
            'cpf' => 'required|string|size:11|unique:users,cpf,' . $editId,
            'address' => 'required|string|max:255',
            'date_birth' => 'required|date|before:today',
            'telephone' => 'required|string|min:6|max:15',
            'password' => 'nullable|string|min:6',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'Informe um email válido.',
            'email.unique' => 'Este email já está em uso.',
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.size' => 'O CPF deve ter exatamente 11 dígitos.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'address.required' => 'O endereço é obrigatório.',
            'date_birth.required' => 'A data de nascimento é obrigatória.',
            'date_birth.before' => 'A data de nascimento deve ser anterior a hoje.',
            'telephone.required' => 'O telefone é obrigatório.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
            'password.confirmed' => 'As senhas não coincidem.',
            'photo.image' => 'O arquivo deve ser uma imagem.',
            'photo.max' => 'A foto deve ter no máximo 2MB.',
        ];
    }
}
