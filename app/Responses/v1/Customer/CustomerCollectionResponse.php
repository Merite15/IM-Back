<?php

declare(strict_types=1);

namespace App\Responses\v1\Customer;

use App\Http\Resources\v1\Customer\CustomerCollection;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

final class CustomerCollectionResponse implements Responsable
{
    public function __construct(
        private readonly CustomerCollection $customerCollection,
        private readonly int $status = Response::HTTP_OK,
    ) {}

    public function toResponse($request): JsonResponse
    {
        return response()->json(
            data: $this->customerCollection,
            status: $this->status,
        );
    }
}
