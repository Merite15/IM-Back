<?php

declare(strict_types=1);

namespace App\Actions\v1\Company;

use App\DTO\v1\CompanyDTO;
use App\Models\Company;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Throwable;

final class StoreCompany
{
    public function handle(CompanyDTO $dto): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            $company = Company::create([
                'name' => $dto->getName(),
                'address' => $dto->getAddress(),
                'phone' => $dto->getPhone(),
            ]);

            $company->users()->attach(auth()->user()->id);

            return new ApiSuccessResponse(
                message: "Compagnie ajoutée avec succès",
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
