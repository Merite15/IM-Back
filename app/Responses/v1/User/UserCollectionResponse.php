<?php

declare(strict_types=1);

namespace App\Responses\v1\User;

use App\Http\Resources\v1\User\UserCollection;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

final class UserCollectionResponse implements Responsable
{
    public function __construct(
        private readonly UserCollection $userCollection,
        private readonly int $status = Response::HTTP_OK,
    ) {}

    public function toResponse($request): JsonResponse
    {
        return response()->json(
            data: $this->userCollection,
            status: $this->status,
        );
    }
}
