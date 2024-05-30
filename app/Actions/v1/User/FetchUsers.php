<?php

declare(strict_types=1);

namespace App\Actions\v1\User;

use App\Http\Resources\v1\User\UserCollection;
use App\Models\User;
use App\Responses\ApiErrorResponse;
use App\Responses\v1\User\UserCollectionResponse;
use Throwable;

final class FetchUsers
{
    public function handle(): ApiErrorResponse | UserCollectionResponse
    {
        try {
            return new UserCollectionResponse(
                userCollection: new UserCollection(
                    resource: User::query()->latest()->get(),
                ),
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
            );
        }
    }
}
