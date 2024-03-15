<?php

declare(strict_types=1);

namespace App\Actions\v1\Product;

use App\Http\Resources\v1\Product\ProductCollection;
use App\Models\Product;
use App\Responses\ApiErrorResponse;
use App\Responses\v1\Product\ProductCollectionResponse;
use Throwable;

final class FetchProducts
{
    public function handle(): ApiErrorResponse | ProductCollectionResponse
    {
        try {
            return new ProductCollectionResponse(
                productCollection: new ProductCollection(
                    resource: Product::query()->with(['category', 'supplier'])->latest()->get()
                ),
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception
            );
        }
    }
}
