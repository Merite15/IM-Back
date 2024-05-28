<?php

declare(strict_types=1);

namespace App\Actions\v1\Unit;

use App\DTO\v1\UnitDTO;
use App\Models\Unit;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Throwable;

final class UpdateUnit
{
    public function handle(string $id, UnitDTO $dto): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            $unit = Unit::query()->findOrFail($id);

            $unit->update([
                'name' => $dto->getName(),
                'slug' =>  Str::slug($dto->getSlug()),
                'short_code' =>  Str::slug($dto->getShortCode()),
            ]);

            return new ApiSuccessResponse(message: 'Element modifié avec succès');
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: Response::HTTP_NOT_FOUND
            );
        }
    }
}
