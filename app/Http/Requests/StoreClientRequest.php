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
            'contact_name' => ['required', 'max:255'],
            'contact_email' => ['required', 'max:255'],
            'contact_phone_number' => ['required', 'max:255'],
            'company_name' => ['required', 'max:255'],
            'company_address' => ['required', 'max:255'],
            'company_city' => ['required', 'max:255'],
            'company_zip' => ['required', 'max:255'],
            'company_vat' => ['required', 'max:255'],
        ];
    }
}
