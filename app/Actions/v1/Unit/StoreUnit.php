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

final class StoreUnit
{
    public function handle(UnitDTO $dto): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            Unit::create([
                'name' => $dto->getName(),
                'short_code' =>  Str::slug($dto->getShortCode()),
                'company_id' => auth()->user()->current_company,
            ]);

            return new ApiSuccessResponse(
                message: "Unité ajoutée avec succès",
                code: Response::HTTP_CREATED,
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: Response::HTTP_NOT_FOUND,
            );
        }
    }
}
