<?php

declare(strict_types=1);

namespace App\Actions\v1\Category;

use App\DTO\v1\CategoryDTO;
use App\Models\Category;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Throwable;

final class UpdateCategory
{
    public function handle(string $id, CategoryDTO $dto): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            $category = Category::query()->findOrFail($id);

            $category->update([
                'name' => $dto->getName(),
            ]);

            return new ApiSuccessResponse(message: 'Catégorie modifiée avec succès');
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: Response::HTTP_NOT_FOUND,
            );
        }
    }
}
