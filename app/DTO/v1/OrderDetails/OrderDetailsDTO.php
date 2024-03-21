<?php

declare(strict_types=1);

namespace App\DTO\v1\OrderDetails;

use Illuminate\Http\Request;

final class OrderDetailsDTO
{
    public function __construct(
        private readonly int $order_id,
        private readonly int $unit_cost,
        private readonly int $product_id,
        private readonly int $quantity,
        private readonly int $total,
    ) {
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            (int)$request->input('order_id'),
            (int)$request->input('unit_cost'),
            (int)$request->input('product_id'),
            (int)$request->input('quantity'),
            (int)$request->input('total')
        );
    }

    public function toArray(): array
    {
        return [
            'order_id' => $this->order_id,
            'unit_cost' => $this->unit_cost,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'total' => $this->total,
        ];
    }

    public function getOrderId(): int
    {
        return $this->order_id;
    }

    public function getUnitCost(): int
    {
        return $this->unit_cost;
    }

    public function getProductId(): int
    {
        return $this->product_id;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getTotal(): int
    {
        return $this->total;
    }
}
