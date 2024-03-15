<?php

declare(strict_types=1);

namespace App\Responses\v1\Supplier;

use App\Http\Resources\v1\Supplier\SupplierCollection;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

final class SupplierCollectionResponse implements Responsable
{
    public function __construct(
        private readonly SupplierCollection $supplierCollection,
        private readonly int $status = Response::HTTP_OK,
    ) {}

    public function toResponse($request): JsonResponse
    {
        return response()->json(
            data: $this->supplierCollection,
            status: $this->status,
        );
    }
}
