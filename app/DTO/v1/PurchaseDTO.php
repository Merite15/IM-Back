<?php

declare(strict_types=1);

namespace App\DTO\v1;

use Illuminate\Http\Request;

final class PurchaseDTO
{
    public function __construct(
        private readonly string $date,
        private readonly int $supplier_id,
        private readonly int $total_amount,
        private readonly array $products,
    ) {
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            (string) $request->input('date'),
            (int) $request->input('supplier_id'),
            (int) $request->input('total_amount'),
            $request->input('products'),
        );
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getSupplierId(): int
    {
        return $this->supplier_id;
    }

    public function getTotalAmount(): int
    {
        return $this->total_amount;
    }

    public function getProducts(): array
    {
        return $this->products;
    }
}
