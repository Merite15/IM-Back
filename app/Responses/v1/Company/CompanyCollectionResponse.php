<?php

declare(strict_types=1);

namespace App\Responses\v1\Company;

use App\Http\Resources\v1\Company\CompanyCollection;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

final class CompanyCollectionResponse implements Responsable
{
    public function __construct(
        private readonly CompanyCollection $companyCollection,
        private readonly int $status = Response::HTTP_OK,
    ) {
    }

    public function toResponse($request): JsonResponse
    {
        return response()->json(
            data: $this->companyCollection,
            status: $this->status,
        );
    }
}
