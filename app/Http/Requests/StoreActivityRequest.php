<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreActivityRequest extends FormRequest
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
            'date' => ['required', 'date', 'before_or_equal:today'],
            'type' => ['required', 'in:bike,walk'],
            'distance_km' => ['nullable', 'numeric', 'min:0.1', 'required_if:type,bike'],
            'steps' => ['nullable', 'integer', 'min:1', 'required_if:type,walk'],
        ];
    }

    public function messages(): array
    {
        return [
            'date.before_or_equal' => 'La date ne peut pas être dans le futur.',
            'distance_km.required_if' => 'La distance est requise pour une activité vélo.',
            'steps.required_if' => 'Le nombre de pas est requis pour la marche/course.',
        ];
    }
}
