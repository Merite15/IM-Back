<?php

declare(strict_types=1);

namespace App\Actions\v1\Role;

use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Spatie\Permission\Models\Role;
use Throwable;

final class FetchRoles
{
    public function handle(): ApiErrorResponse | ApiSuccessResponse
    {
        try {
            return new ApiSuccessResponse(
                message: 'Roles récupérés avec succès',
                data: Role::query()->with('permissions')->get(),
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
            );
        }
    }
}
