<?php

declare(strict_types=1);

namespace App\Actions\v1\Product;

use App\Models\Product;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Throwable;

final class DestroyProduct
{
    public function handle(string $id): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            $product = Product::query()->findOrFail($id);

            if ($product->image) {
                Storage::delete('public/products/' . $product->product_image);
            }

            $product->delete();

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
