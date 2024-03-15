<?php

declare(strict_types=1);

namespace App\Actions\v1\Category;

use App\Http\Resources\v1\Category\CategoryCollection;
use App\Models\Category;
use App\Responses\ApiErrorResponse;
use App\Responses\v1\Category\CategoryCollectionResponse;
use Throwable;

final class FetchCategories
{
    public function handle(): ApiErrorResponse | CategoryCollectionResponse
    {
        try {
            return new CategoryCollectionResponse(
                categoryCollection: new CategoryCollection(
                    resource: Category::query()->latest()->get()
                ),
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception
            );
        }
    }
}
