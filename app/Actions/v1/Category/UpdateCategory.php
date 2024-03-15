<?php

declare(strict_types=1);

namespace App\Actions\v1\Category;

use App\DTO\v1\Category\CategoryDTO;
use App\Models\Category;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Throwable;
use Illuminate\Support\Str;

final class UpdateCategory
{
    public function handle(string $id, CategoryDTO $dto): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            $data = $dto->toArray();

            $category = Category::query()->findOrFail($id);

            $category->update([
                'name' => $data['name'],
                'slug' =>  Str::slug($data['slug']),
            ]);

            return new ApiSuccessResponse(
                message: 'Element modifié avec succès',
                data: $category,
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: Response::HTTP_NOT_FOUND
            );
        }
    }
}
