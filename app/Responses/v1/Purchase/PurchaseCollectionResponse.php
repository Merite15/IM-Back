<?php

declare(strict_types=1);

namespace App\Responses\v1\Purchase;

use App\Http\Resources\v1\Purchase\PurchaseCollection;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

final class PurchaseCollectionResponse implements Responsable
{
    public function __construct(
        private readonly PurchaseCollection $purchaseCollection,
        private readonly int $status = Response::HTTP_OK,
    ) {}

    public function toResponse($request): JsonResponse
    {
        return response()->json(
            data: $this->purchaseCollection,
            status: $this->status,
        );
    }
}
