<?php

declare(strict_types=1);

namespace App\DTO\v1\Order;

use App\Enums\OrderStatus;
use App\Enums\PaymentType;
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
        private readonly PaymentType $payment_type,
        private readonly int $pay,
        private readonly int $due,
    ) {
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            (string)$request->input('date'),
            (int)$request->input('customer_id'),
            OrderStatus::from($request->input('status')),
            (int)$request->input('total_products'),
            (int)$request->input('sub_total'),
            (int)$request->input('vat'),
            (string)$request->input('invoice_no'),
            (int)$request->input('total'),
            PaymentType::from($request->input('payment_type')),
            (int)$request->input('pay'),
            (int)$request->input('due')
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
            'payment_type' => $this->payment_type,
            'pay' => $this->pay,
            'due' => $this->due,
        ];
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getCustomerId(): int
    {
        return $this->customer_id;
    }

    public function getStatus(): OrderStatus
    {
        return $this->status;
    }

    public function getTotalProducts(): int
    {
        return $this->total_products;
    }

    public function getSubTotal(): int
    {
        return $this->sub_total;
    }

    public function getVat(): int
    {
        return $this->vat;
    }

    public function getInvoiceNo(): string
    {
        return $this->invoice_no;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getPaymentType(): PaymentType
    {
        return $this->payment_type;
    }

    public function getPay(): int
    {
        return $this->pay;
    }

    public function getDue(): int
    {
        return $this->due;
    }
}
