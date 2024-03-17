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
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->input('name'),
            $request->input('slug'),
            $request->input('quantity'),
            $request->input('buying_price'),
            $request->input('selling_price'),
            $request->input('quantity_alert'),
            $request->input('tax'),
            $request->input('tax_type'),
            $request->input('notes'),
            $request->input('image'),
            $request->input('category_id'),
            $request->input('unit_id')
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
}
