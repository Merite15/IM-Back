<?php

declare(strict_types=1);

namespace App\Responses\v1\Unit;

use App\Http\Resources\v1\Unit\UnitCollection;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

final class UnitCollectionResponse implements Responsable
{
    public function __construct(
        private readonly UnitCollection $unitCollection,
        private readonly int $status = Response::HTTP_OK,
    ) {
    }

    public function toResponse($request): JsonResponse
    {
        return response()->json(
            data: $this->unitCollection,
            status: $this->status,
        );
    }
}
