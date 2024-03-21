<?php

declare(strict_types=1);

namespace App\Actions\v1\Customer;

use App\DTO\v1\Customer\CustomerDTO;
use App\Models\Customer;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Throwable;

final class UpdateCustomer
{
    public function handle(string $id, CustomerDTO $dto): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            $customer = Customer::query()->findOrFail($id);

            $customer->update([
                'name' => $dto->getName(),
                'email' => $dto->getEmail(),
                'address' => $dto->getAddress(),
                'phone' => $dto->getPhone(),
                'shop_name' => $dto->getShopName(),
                'gender' => $dto->getGender(),
                'city' => $dto->getCity(),
            ]);

            return new ApiSuccessResponse(message: 'Client modifié avec succès');
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: Response::HTTP_NOT_FOUND
            );
        }
    }
}
