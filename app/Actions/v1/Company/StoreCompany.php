<?php

declare(strict_types=1);

namespace App\Actions\v1\Company;

use App\DTO\v1\Company\CompanyDTO;
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
            $data = $dto->toArray();

            $company = Company::create([
                'name' => $data['name'],
                'address' => $data['address'],
                'phone' => $data['phone']
            ]);

            $company->users()->attach(auth()->user()->id);

            return new ApiSuccessResponse(
                data: $company,
                message: "Compagnie ajoutée avec succès",
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
