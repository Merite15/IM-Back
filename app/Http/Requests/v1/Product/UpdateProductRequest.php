<?php

declare(strict_types=1);

namespace App\Http\Requests\v1\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'image' => 'image|file|max:1024',
            'name' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'supplier_id' => 'required|integer|exists:suppliers,id',
            'garage' => 'string|nullable',
            'store' => 'string|nullable',
            'buying_date' => 'date_format:Y-m-d|max:10|nullable',
            'expire_date' => 'date_format:Y-m-d|max:10|nullable',
            'buying_price' => 'required|integer',
            'selling_price' => 'required|integer',
        ];
    }
}
