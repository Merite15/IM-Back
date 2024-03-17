<?php

declare(strict_types=1);

namespace App\Http\Requests\v1\Purchase;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseRequest extends FormRequest
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
            'supplier_id' => 'integer|required|exists:suppliers,id',
            'date'          => 'required|string',
            'total_amount'  => 'required|numeric',
            'products'  => 'required|array',
        ];
    }
}
