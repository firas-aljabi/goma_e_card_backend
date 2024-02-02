<?php

namespace App\Http\Requests\user\CreateProfile;

use Illuminate\Foundation\Http\FormRequest;

class step3ProfileRequest extends FormRequest
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

            'cover' => 'nullable|image',
            'photo' => 'nullable|image',

        ];
    }
}
