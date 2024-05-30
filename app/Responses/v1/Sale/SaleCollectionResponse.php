<?php

declare(strict_types=1);

namespace App\Responses\v1\Sale;

use App\Http\Resources\v1\Sale\SaleCollection;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

final class SaleCollectionResponse implements Responsable
{
    public function __construct(
        private readonly SaleCollection $saleCollection,
        private readonly int $status = Response::HTTP_OK,
    ) {}

    public function toResponse($request): JsonResponse
    {
        return response()->json(
            data: $this->saleCollection,
            status: $this->status,
        );
    }
}
