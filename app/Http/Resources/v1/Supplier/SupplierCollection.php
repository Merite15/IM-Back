<?php

declare(strict_types=1);

namespace App\Http\Resources\v1\Supplier;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SupplierCollection extends ResourceCollection
{
    public $collects = SupplierResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'message' => "Fournisseurs récupérés avec succès",
            'data' => $this->collection,
        ];
    }
}
