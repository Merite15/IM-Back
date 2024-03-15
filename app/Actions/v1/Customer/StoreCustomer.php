<?php

declare(strict_types=1);

namespace App\Actions\v1\Customer;

use App\DTO\v1\Customer\CustomerDTO;
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
            $data = $dto->toArray();

            $customer = Customer::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'address' => $data['address'],
                'phone' => $data['phone'],
                'shop_name' => $data['shop_name'],
                'gender' => $data['gender'],
                'city' => $data['city'],
            ]);

            return new ApiSuccessResponse(
                data: $customer,
                message: "Client ajouté avec succès",
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
