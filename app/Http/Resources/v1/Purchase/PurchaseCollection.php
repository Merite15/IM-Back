<?php

namespace App\Http\Resources\v1\Purchase;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PurchaseCollection extends ResourceCollection
{
    public $collects = PurchaseResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'message' => "Achats récupérés avec succès",
            'data' => $this->collection,
        ];
    }
}
