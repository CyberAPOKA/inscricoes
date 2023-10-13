<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo é obrigatório.',
            'min' => 'O campo deve ter no mínimo :min caracteres.',
            'max' => 'O campo deve ter no máximo :max caracteres.',
            'date' => 'O campo deve ser uma data.',
            'url' => 'Deve ser uma URL Válida (verifique o https:// antes do www).',
            'formato_cep' => 'O campo CEP não possui um formato válido de CEP.'
        ];
    }
}
