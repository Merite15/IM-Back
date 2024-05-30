<?php

declare(strict_types=1);

namespace App\Actions\v1\Company;

use App\Models\Company;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Throwable;

final class DestroyCompany
{
    public function handle(string $id): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            $company = Company::query()->findOrFail($id);

            $company->users()->detach();

            $company->delete();

            return new ApiSuccessResponse(
                message: 'Element supprimé avec succès',
                code: Response::HTTP_OK,
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: $exception->getCode(),
            );
        }
    }
}
