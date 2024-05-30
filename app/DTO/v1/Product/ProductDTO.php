<?php

declare(strict_types=1);

namespace App\DTO\v1\Product;

use Illuminate\Http\Request;

final class ProductDTO
{
    public function __construct(
        private readonly string $name,
        private readonly int $quantity,
        private readonly int $buying_price,
        private readonly int $selling_price,
        private readonly int $quantity_alert,
        private readonly ?string $notes = null,
        private readonly ?string $image = null,
        private readonly int $category_id,
        private readonly int $unit_id,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            (string) $request->input('name'),
            (int) $request->input('quantity'),
            (int) $request->input('buying_price'),
            (int) $request->input('selling_price'),
            (int) $request->input('quantity_alert'),
            (string) $request->input('notes'),
            (string) $request->input('image'),
            (int) $request->input('category_id'),
            (int) $request->input('unit_id'),
        );
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getBuyingPrice(): int
    {
        return $this->buying_price;
    }

    public function getSellingPrice(): int
    {
        return $this->selling_price;
    }

    public function getQuantityAlert(): int
    {
        return $this->quantity_alert;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    public function getUnitId(): int
    {
        return $this->unit_id;
    }
}
