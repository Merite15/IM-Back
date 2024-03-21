<?php

declare(strict_types=1);

namespace App\Actions\v1\Company;

use App\DTO\v1\Company\CompanyDTO;
use App\Models\Company;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Throwable;

final class UpdateCompany
{
    public function handle(string $id, CompanyDTO $dto): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            $company = Company::query()->findOrFail($id);

            $company->update([
                'name' => $dto->getName(),
                'address' => $dto->getAddress(),
                'phone' => $dto->getPhone()
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
