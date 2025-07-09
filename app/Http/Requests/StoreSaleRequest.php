<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSaleRequest extends FormRequest
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
            'client_id' => ['required', 'exists:clients,id'],
            'total' => ['required', 'numeric', 'min:0.01'],
            'sold_at' => ['required', 'date'],
            'payment_type' => ['required', 'in:cash,installment'],
            'installments_count' => [
                'nullable',
                'integer',
                'min:1',
                'max:36',
                Rule::requiredIf($this->payment_type === 'installment'),
            ],
            'entry_value' => [
                'nullable',
                'numeric',
                'min:0',
                Rule::requiredIf($this->payment_type === 'installment'),
            ],
            'first_due_date' => [
                'nullable',
                'date',
                Rule::requiredIf($this->payment_type === 'installment'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'installments_count.required' => 'Informe a quantidade de parcelas.',
        ];
    }
}
