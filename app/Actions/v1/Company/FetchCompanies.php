<?php

declare(strict_types=1);

namespace App\Actions\v1\Company;

use App\Http\Resources\v1\Company\CompanyCollection;
use App\Models\Company;
use App\Responses\ApiErrorResponse;
use App\Responses\v1\Company\CompanyCollectionResponse;
use Throwable;

final class FetchCompanies
{
    public function handle(): ApiErrorResponse | CompanyCollectionResponse
    {
        try {
            return new CompanyCollectionResponse(
                companyCollection: new CompanyCollection(
                    resource: Company::query()->latest()->get(),
                ),
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
            );
        }
    }
}
