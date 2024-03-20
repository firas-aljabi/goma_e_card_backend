<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class VisitProfileRequest extends FormRequest
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
            'profile_id' => ['required', 'exists:profiles,user_id'],
            'address' => ['required'],
        ];
    }
}
