<?php

declare(strict_types=1);

namespace App\Http\Requests\v1\Customer;

use App\Enums\UserGender;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreCustomerRequest extends FormRequest
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
            'email' => 'required|max:50|email:rfc,dns,spoof,filter,filter_unicode|unique:customers,email,filter',
            'phone' => 'required|string|size:9|unique:customers,phone',
            'shop_name' => 'required|string|max:50',
            'city' => 'required|string|max:50',
            'address' => 'required|string|max:100',
        ];
    }
}
