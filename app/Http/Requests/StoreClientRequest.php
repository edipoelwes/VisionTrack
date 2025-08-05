<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'string', 'regex:/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/', 'max:14', 'unique:clients,cpf'],
            'phone' => ['nullable', 'string'],
            'email' => ['nullable', 'email'],

            'addresses' => ['required', 'array', 'min:1'],
            'addresses.*.type' => ['required', 'in:residential,commercial'],
            'addresses.*.street' => ['required', 'string'],
            'addresses.*.number' => ['required', 'string'],
            'addresses.*.complement' => ['nullable', 'string'],
            'addresses.*.neighborhood' => ['required', 'string'],
            'addresses.*.city' => ['required', 'string'],
            'addresses.*.state' => ['required', 'string'],
            'addresses.*.zip_code' => ['required', 'string'],

            'prescriptions' => ['nullable', 'array'],
            'prescriptions.*.file' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:10240'],
            'prescriptions.*.issued_at' => ['required', 'date'],
            'prescriptions.*.notes' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'cpf.regex' => 'O CPF deve estar no formato 000.000.000-00.',
            'prescriptions.*.file.max' => 'Cada arquivo deve ter no máximo 10MB.',
        ];
    }
}
