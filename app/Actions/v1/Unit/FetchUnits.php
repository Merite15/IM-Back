<?php

declare(strict_types=1);

namespace App\Actions\v1\Unit;

use App\Http\Resources\v1\Unit\UnitCollection;
use App\Models\Unit;
use App\Responses\ApiErrorResponse;
use App\Responses\v1\Unit\UnitCollectionResponse;
use Throwable;

final class FetchUnits
{
    public function handle(): ApiErrorResponse | UnitCollectionResponse
    {
        try {
            return new UnitCollectionResponse(
                unitCollection: new UnitCollection(
                    resource: Unit::query()->latest()->get()
                ),
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception
            );
        }
    }
}
