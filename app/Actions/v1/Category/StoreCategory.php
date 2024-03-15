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

final class StoreCategory
{
    public function handle(CategoryDTO $dto): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            $data = $dto->toArray();

            $category = Category::create([
                'name' => $data['name'],
                'slug' =>  Str::slug($data['slug']),
            ]);

            return new ApiSuccessResponse(
                data: $category,
                message: "Avance de salaire ajoutée avec succès",
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
