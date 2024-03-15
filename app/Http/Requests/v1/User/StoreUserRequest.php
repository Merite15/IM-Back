<?php

declare(strict_types=1);

namespace App\Http\Requests\v1\User;

use App\Enums\UserGender;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
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
            'gender' => ['required', new Enum(UserGender::class)],
            'phone' => 'required|string|unique:users,phone|min:9',
            'role_id' => 'integer|required|exists:roles,id',
            'email' => 'required|max:50|email:rfc,dns,spoof,filter,filter_unicode|unique:users,email,filter',
            'password' => ['required', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()],
        ];
    }
}
