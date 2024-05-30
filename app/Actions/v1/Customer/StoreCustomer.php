<?php

declare(strict_types=1);

namespace App\Actions\v1\Customer;

use App\DTO\v1\CustomerDTO;
use App\Models\Customer;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Throwable;

final class StoreCustomer
{
    public function handle(CustomerDTO $dto): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            Customer::create([
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
                message: "Client ajouté avec succès",
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
