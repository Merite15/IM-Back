<?php

declare(strict_types=1);

namespace App\Http\Requests\v1\Customer;

use App\Enums\UserGender;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateCustomerRequest extends FormRequest
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
            'email' => 'required|max:50|indisposable|email:rfc,dns,spoof,filter,filter_unicode|unique:customers,email,filter' . $this->customer,
            'phone' => 'required|string|size:9|unique:customers,phone,' . $this->customer,
            'shop_name' => 'required|string|max:50',
            'city' => 'required|string|max:50',
            'address' => 'required|string|max:100',
        ];
    }
}
