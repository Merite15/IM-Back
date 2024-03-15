<?php

declare(strict_types=1);

namespace App\Actions\v1\Unit;

use App\Http\Resources\v1\Unit\UnitResource;
use App\Models\Unit;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Throwable;

final class ShowUnit
{
    public function handle(string $id): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            return new ApiSuccessResponse(
                message: 'Element récupéré avec succès',
                data: new UnitResource(Unit::query()->findOrFail($id)),
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: Response::HTTP_NOT_FOUND
            );
        }
    }
}
