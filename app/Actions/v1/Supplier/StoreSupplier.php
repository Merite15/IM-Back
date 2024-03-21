<?php

declare(strict_types=1);

namespace App\Actions\v1\Supplier;

use App\DTO\v1\Supplier\SupplierDTO;
use App\Models\Supplier;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Throwable;

final class StoreSupplier
{
    public function handle(SupplierDTO $dto): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            Supplier::create([
                'type' => $dto->getType(),
                'name' => $dto->getName(),
                'email' => $dto->getEmail(),
                'address' => $dto->getAddress(),
                'phone' => $dto->getPhone(),
                'shop_name' => $dto->getShopName(),
                'gender' => $dto->getGender(),
                'city' => $dto->getCity(),
                'company_id' => auth()->user()->current_company,
            ]);

            return new ApiSuccessResponse(
                message: "fournisseur ajouté avec succès",
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
