<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClanUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'ime' => ['required', 'string', 'max:30'],
            'prezime' => ['required', 'string', 'max:30'],
            'godina_rodjenja' => ['required', 'date'],
            'fide_rejting' => ['required', 'numeric'],
            'kategorija_id' => ['required', 'integer', 'exists:Kategorija,id'],
        ];
    }
}
