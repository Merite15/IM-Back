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

final class StoreUnit
{
    public function handle(UnitDTO $dto): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            $data = $dto->toArray();

            $Unit = Unit::create([
                'name' => $data['name'],
                'slug' =>  Str::slug($data['slug']),
                'short_code' =>  Str::slug($data['short_code']),
                'company_id' => auth()->user()->current_company,
            ]);

            return new ApiSuccessResponse(
                data: $Unit,
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
