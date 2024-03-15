<?php

declare(strict_types=1);

namespace App\Actions\v1\Unit;

use App\DTO\v1\Unit\UnitDTO;
use App\Models\Unit;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Throwable;
use Illuminate\Support\Str;

final class UpdateUnit
{
    public function handle(string $id, UnitDTO $dto): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            $data = $dto->toArray();

            $unit = Unit::query()->findOrFail($id);

            $unit->update([
                'name' => $data['name'],
                'slug' =>  Str::slug($data['slug']),
                'short_code' =>  Str::slug($data['short_code']),
            ]);

            return new ApiSuccessResponse(
                message: 'Element modifié avec succès',
                data: $unit,
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: Response::HTTP_NOT_FOUND
            );
        }
    }
}
