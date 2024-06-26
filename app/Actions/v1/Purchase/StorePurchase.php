<?php

declare(strict_types=1);

namespace App\Actions\v1\Purchase;

use App\DTO\v1\PurchaseDTO;
use App\Models\Purchase;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Throwable;

final class StorePurchase
{
    public function handle(PurchaseDTO $dto): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            DB::beginTransaction();

            $purchase = Purchase::create([
                'purchase_no' => IdGenerator::generate([
                    'table' => 'purchases',
                    'field' => 'purchase_no',
                    'length' => 10,
                    'prefix' => 'PRS-',
                ]),
                'supplier_id'   => $dto->getSupplierId(),
                'date'          => $dto->getDate(),
                'total_amount'  => $dto->getTotalAmount(),
                'company_id' => auth()->user()->current_company,
            ]);

            if ($dto->getProducts() !== null) {
                $details = [];

                foreach ($dto->getProducts() as $product) {
                    $details['purchase_id']    = $purchase['id'];
                    $details['product_id']     = $product['product_id'];
                    $details['quantity']       = $product['quantity'];
                    $details['unit_cost']       = $product['unit_cost'];
                    $details['total']          = ($product['quantity'] * $product['unit_cost']);
                    $details['created_at']     = Carbon::now();
                    $details['company_id'] = auth()->user()->current_company;

                    $purchase->details()->insert($details);
                }
            }

            DB::commit();

            return new ApiSuccessResponse(
                message: "Achat ajouté avec succès",
                code: Response::HTTP_CREATED,
            );
        } catch (Throwable $exception) {
            DB::rollBack();

            return new ApiErrorResponse(
                exception: $exception,
                code: Response::HTTP_NOT_FOUND,
            );
        }
    }
}
