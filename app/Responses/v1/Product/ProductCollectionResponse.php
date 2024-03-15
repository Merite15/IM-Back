<?php

declare(strict_types=1);

namespace App\Responses\v1\Product;

use App\Http\Resources\v1\Product\ProductCollection;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

final class ProductCollectionResponse implements Responsable
{
    public function __construct(
        private readonly ProductCollection $productCollection,
        private readonly int $status = Response::HTTP_OK,
    ) {
    }

    public function toResponse($request): JsonResponse
    {
        return response()->json(
            data: $this->productCollection,
            status: $this->status,
        );
    }
}
