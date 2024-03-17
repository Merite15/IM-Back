<?php

declare(strict_types=1);

namespace App\Responses\v1\Order;

use App\Http\Resources\v1\Order\OrderCollection;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

final class OrderCollectionResponse implements Responsable
{
    public function __construct(
        private readonly OrderCollection $orderCollection,
        private readonly int $status = Response::HTTP_OK,
    ) {}

    public function toResponse($request): JsonResponse
    {
        return response()->json(
            data: $this->orderCollection,
            status: $this->status,
        );
    }
}
