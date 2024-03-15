<?php

declare(strict_types=1);

namespace App\DTO\v1\Order;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use Illuminate\Http\Request;

final class OrderDTO
{
    public function __construct(
        private readonly string $date,
        private readonly int $customer_id,
        private readonly OrderStatus $status,
        private readonly int $total_products,
        private readonly int $sub_total,
        private readonly int $vat,
        private readonly string $invoice_no,
        private readonly int $total,
        private readonly PaymentStatus $payment_status,
        private readonly int $pay,
        private readonly int $due,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->input('date'),
            $request->input('customer_id'),
            $request->input('status'),
            $request->input('total_products'),
            $request->input('sub_total'),
            $request->input('vat'),
            $request->input('invoice_no'),
            $request->input('total'),
            $request->input('payment_status'),
            $request->input('pay'),
            $request->input('due')
        );
    }

    public function toArray(): array
    {
        return [
            'date' => $this->date,
            'customer_id' => $this->customer_id,
            'status' => $this->status,
            'total_products' => $this->total_products,
            'sub_total' => $this->sub_total,
            'vat' => $this->vat,
            'invoice_no' => $this->invoice_no,
            'total' => $this->total,
            'payment_status' => $this->payment_status,
            'pay' => $this->pay,
            'due' => $this->due,
        ];
    }
}
