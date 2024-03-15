<?php

declare(strict_types=1);

namespace App\Http\Requests\v1\Supplier;

use App\Enums\UserGender;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreSupplierRequest extends FormRequest
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
            'email' => 'required|max:50|email:rfc,dns,spoof,filter,filter_unicode|unique:suppliers,email,filter',
            'phone' => 'required|string|size:9|unique:suppliers,phone',
            'shop_name' => 'required|string|max:50',
            'type' => 'required|string|max:25',
            'account_holder' => 'nullable|string|max:50',
            'account_number' => 'nullable|string|max:25',
            'bank_name' => 'nullable|string|max:25',
            'bank_branch' => 'nullable|string|max:50',
            'city' => 'required|string|max:50',
            'address' => 'required|string|max:100',
        ];
    }
}
