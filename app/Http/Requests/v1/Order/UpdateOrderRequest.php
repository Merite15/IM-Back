<?php

declare(strict_types=1);

namespace App\Http\Requests\v1\Order;

use App\Enums\OrderStatus;
use App\Enums\PaymentType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateOrderRequest extends FormRequest
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
            'customer_id' => 'required|integer|exists:customers,id',
            'status' => ['required', new Enum(OrderStatus::class)],
            'total_products' => 'required|integer|min:0',
            'sub_total' => 'required|numeric|min:0',
            'vat' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'invoice_no' => 'required|string',
            'payment_type' => ['required', new Enum(PaymentType::class)],
            'pay' => 'nullable|numeric|min:0',
            'due' => 'nullable|numeric|min:0',
        ];
    }
}
