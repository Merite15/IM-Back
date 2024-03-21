<?php

declare(strict_types=1);

namespace App\DTO\v1\Product;

use App\Enums\TaxType;
use Illuminate\Http\Request;

final class ProductDTO
{
    public function __construct(
        private readonly string $name,
        private readonly string $slug,
        private readonly int $quantity,
        private readonly int $buying_price,
        private readonly int $selling_price,
        private readonly int $quantity_alert,
        private readonly ?int $tax = null,
        private readonly TaxType $tax_type,
        private readonly ?string $notes = null,
        private readonly ?string $image = null,
        private readonly int $category_id,
        private readonly int $unit_id,
    ) {
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            (string)$request->input('name'),
            (string)$request->input('slug'),
            (int)$request->input('quantity'),
            (int)$request->input('buying_price'),
            (int)$request->input('selling_price'),
            (int)$request->input('quantity_alert'),
            (int)$request->input('tax'),
            TaxType::from($request->input('tax_type')),
            (string)$request->input('notes'),
            (string)$request->input('image'),
            (int)$request->input('category_id'),
            (int)$request->input('unit_id')
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'quantity' => $this->quantity,
            'buying_price' => $this->buying_price,
            'selling_price' => $this->selling_price,
            'quantity_alert' => $this->quantity_alert,
            'tax' => $this->tax,
            'tax_type' => $this->tax_type,
            'notes' => $this->notes,
            'image' => $this->image,
            'category_id' => $this->category_id,
            'unit_id' => $this->unit_id,
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): string
    {
        return $this->slug;
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

    public function getTax(): ?int
    {
        return $this->tax;
    }

    public function getTaxType(): TaxType
    {
        return $this->tax_type;
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
