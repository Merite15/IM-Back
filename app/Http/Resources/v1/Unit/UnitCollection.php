<?php

namespace App\Http\Resources\v1\Unit;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UnitCollection extends ResourceCollection
{
    public $collects = UnitResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'message' => "Unités récupérées avec succès",
            'data' => $this->collection,
        ];
    }
}
