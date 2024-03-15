<?php

declare(strict_types=1);

namespace App\Responses\v1\Category;

use App\Http\Resources\v1\Category\CategoryCollection;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

final class CategoryCollectionResponse implements Responsable
{
    public function __construct(
        private readonly CategoryCollection $categoryCollection,
        private readonly int $status = Response::HTTP_OK,
    ) {}

    public function toResponse($request): JsonResponse
    {
        return response()->json(
            data: $this->categoryCollection,
            status: $this->status,
        );
    }
}
