<?php

declare(strict_types=1);

namespace App\Actions\v1\Supplier;

use App\Http\Resources\v1\Supplier\SupplierResource;
use App\Models\Supplier;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Throwable;

final class ShowSupplier
{
    public function handle(string $id): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            return new ApiSuccessResponse(
                message: 'Element récupéré avec succès',
                data: new SupplierResource(Supplier::query()->findOrFail($id)),
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: Response::HTTP_NOT_FOUND
            );
        }
    }
}
