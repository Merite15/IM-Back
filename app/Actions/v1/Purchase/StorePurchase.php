<?php

declare(strict_types=1);

namespace App\Actions\v1\Purchase;

use App\DTO\v1\Purchase\PurchaseDTO;
use App\Models\Purchase;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Response;
use Throwable;

final class StorePurchase
{
    public function handle(PurchaseDTO $dto): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            $data = $dto->toArray();

            $purchase = Purchase::create([
                'purchase_no' => IdGenerator::generate([
                    'table' => 'purchases',
                    'field' => 'purchase_no',
                    'length' => 10,
                    'prefix' => 'PRS-'
                ]),
                'supplier_id'   => $data['supplier_id'],
                'date'          => $data['date'],
                'total_amount'  => $data['total_amount'],
                'company_id' => auth()->user()->current_company,
            ]);

            if (!$data['products'] == null) {
                $details = [];

                foreach ($data['products'] as $product) {
                    $details['purchase_id']    = $purchase['id'];
                    $details['product_id']     = $product['product_id'];
                    $details['quantity']       = $product['quantity'];
                    $details['unit_cost']       = intval($product['unit_cost']);
                    $details['total']          = $product['total'];
                    $details['created_at']     = Carbon::now();

                    $purchase->details()->insert($details);
                }
            }

            return new ApiSuccessResponse(
                data: $purchase,
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
