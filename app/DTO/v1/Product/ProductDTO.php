<?php

declare(strict_types=1);

namespace App\DTO\v1\Product;

use Illuminate\Http\Request;

final class ProductDTO
{
    public function __construct(
        private readonly string $name,
        private readonly int $category_id,
        private readonly int $supplier_id,
        private readonly string $garage,
        private readonly int $store,
        private readonly ?string $image = null,
        private readonly string $buying_date,
        private readonly string $expire_date,
        private readonly int $buying_price,
        private readonly int $selling_price,
    ) {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'category_id' => $this->category_id,
            'supplier_id' => $this->supplier_id,
            'garage' => $this->garage,
            'store' => $this->store,
            'image' => $this->image,
            'buying_date' => $this->buying_date,
            'expire_date' => $this->expire_date,
            'buying_price' => $this->buying_price,
            'selling_price' => $this->selling_price,
        ];
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->input('name'),
            $request->input('category_id'),
            $request->input('supplier_id'),
            $request->input('garage'),
            $request->input('store'),
            $request->input('image'),
            $request->input('buying_date'),
            $request->input('expire_date'),
            $request->input('buying_price'),
            $request->input('selling_price')
        );
    }
}
