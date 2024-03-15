<?php

declare(strict_types=1);

namespace App\Http\Resources\v1\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    public $collects = ProductResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'message' => "Produits récupérés avec succès",
            'data' => $this->collection,
        ];
    }
}
