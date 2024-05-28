<?php

declare(strict_types=1);

namespace App\Actions\v1\Category;

use App\DTO\v1\CategoryDTO;
use App\Models\Category;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Throwable;

final class StoreCategory
{
    public function handle(CategoryDTO $dto): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            Category::create([
                'name' => $dto->getName(),
                'company_id' => auth()->user()->current_company,
            ]);

            return new ApiSuccessResponse(
                message: "Catégorie ajoutée avec succès",
                code: Response::HTTP_CREATED
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: Response::HTTP_NOT_FOUND
            );
        }
    }
}
