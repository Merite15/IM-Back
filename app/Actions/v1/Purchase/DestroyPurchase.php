<?php

declare(strict_types=1);

namespace App\Actions\v1\Purchase;

use App\Models\Purchase;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Throwable;

final class DestroyPurchase
{
    public function handle(string $id): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            $purchase = Purchase::query()->findOrFail($id);

            $purchase->details()->delete();

            $purchase->delete();

            return new ApiSuccessResponse(
                message: 'Element supprimé avec succès',
                code: Response::HTTP_OK,
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: $exception->getCode(),
            );
        }
    }
}
