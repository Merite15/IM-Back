<?php

declare(strict_types=1);

namespace App\Http\Requests\v1\Supplier;

use App\Enums\SupplierType;
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
            'type' => ['required', new Enum(SupplierType::class)],
            'email' => 'nullable|max:50|indisposable|email:rfc,dns,spoof,filter,filter_unicode|unique:suppliers,email,filter',
            'phone' => 'required|string|size:9|unique:suppliers,phone',
            'shop_name' => 'required|string|max:50',
            'city' => 'required|string|max:50',
            'address' => 'required|string|max:100',
        ];
    }
}
