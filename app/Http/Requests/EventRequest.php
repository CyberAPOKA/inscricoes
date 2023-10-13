<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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

    // 'start_disclosure_date' => [
    //     'required',
    //     'date',
    //     function ($attribute, $value, $fail) {
    //         $endDisclosureDate = $this->input('end_disclosure_date');
    //         $startDisclosureHour = $this->input('start_disclosure_hour');
    //         $endDisclosureHour = $this->input('end_disclosure_hour');

    //         $startDateTime = $value . ' ' . $startDisclosureHour;
    //         $endDateTime = $endDisclosureDate . ' ' . $endDisclosureHour;

    //         if ($startDateTime > $endDateTime) {
    //             $fail('A data inicial deve ser menor ou igual à data final.');
    //         }
    //     },
    // ],

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3', 'max:255'],
            'organizer' => ['required', 'min:3', 'max:255'],
            'category' => ['required', 'max:255'],
            'date' => ['required', 'date'],
            'hour' => ['required'],
            'start_disclosure_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $endDisclosureDate = $this->input('end_disclosure_date');
                    $startDisclosureHour = $this->input('start_disclosure_hour');
                    $endDisclosureHour = $this->input('end_disclosure_hour');

                    $startDateTime = $value . ' ' . $startDisclosureHour;
                    $endDateTime = $endDisclosureDate . ' ' . $endDisclosureHour;

                    if ($startDateTime > $endDateTime) {
                        $fail('A data inicial deve ser menor ou igual à data final.');
                    }
                },
            ],
            'start_disclosure_hour' => ['required'],
            'end_disclosure_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $startDisclosureDate = $this->input('start_disclosure_date');
                    $startDisclosureHour = $this->input('start_disclosure_hour');
                    $endDisclosureHour = $this->input('end_disclosure_hour');

                    $startDateTime = $startDisclosureDate . ' ' . $startDisclosureHour;
                    $endDateTime = $value . ' ' . $endDisclosureHour;

                    if ($startDateTime > $endDateTime) {
                        $fail('A data final deve ser maior ou igual à data inicial.');
                    }
                },
            ],
            'end_disclosure_hour' => ['required'],
            'description' => ['required', 'min:3', 'max:4000'],
            'terms_and_conditions' => ['required', 'min:3', 'max:4000'],
            'observation' => ['max:4000'],
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
