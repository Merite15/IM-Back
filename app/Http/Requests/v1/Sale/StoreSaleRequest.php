<?php

declare(strict_types=1);

namespace App\Http\Requests\v1\Sale;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
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
            'date' => 'required|date',
            'receipt_no' => 'required|string|max:255',
            'total_amount' => 'required|integer',
            'payment_type' => 'required|string',
            'company_id' => 'required|integer|exists:companies,id',
        ];
    }
}
