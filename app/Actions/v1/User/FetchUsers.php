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
            $users = User::query()->with('roles')->whereHas('companies', function ($query): void {
                $query->where('companies.id', auth()->user()->current_company);
            })->get();

            return new UserCollectionResponse(
                userCollection: new UserCollection(
                    resource: $users,
                ),
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
            );
        }
    }
}
