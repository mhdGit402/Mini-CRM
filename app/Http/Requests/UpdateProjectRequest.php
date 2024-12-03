<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'title' => 'required|string|max:255', // Title is required, must be a string, and max length is 255
            'description' => 'nullable|string', // Description is optional and must be a string
            'user_id' => 'required|exists:users,id', // User ID is required and must exist in the users table
            'client_id' => 'required|exists:clients,id', // Client ID is required and must exist in the clients table
            'deadline_at' => 'required|date|after:today', // Deadline is required, must be a valid date, and must be after today
            'status' => 'required|in:open,in progress,blocked,cancelled,completed', // Status is required and must be one of the defined enum values
        ];
    }
}
