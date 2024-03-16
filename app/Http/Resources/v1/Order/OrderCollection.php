<?php

namespace App\Http\Resources\v1\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderCollection extends ResourceCollection
{
    public $collects = OrderResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'message' => "Commandes récupérées avec succès",
            'data' => $this->collection,
        ];
    }
}
