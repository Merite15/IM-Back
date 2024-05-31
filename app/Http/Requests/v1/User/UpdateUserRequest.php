<?php

declare(strict_types=1);

namespace App\Http\Requests\v1\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'role_id' => 'integer|required|exists:roles,id',
            'companies' => 'array|required',
            'email' => 'required|indisposable|email:rfc,dns,spoof,filter,filter_unicode|unique:users,email,' . $this->user,
        ];
    }
}
