<?php

declare(strict_types=1);

namespace App\Actions\v1\Purchase;

use App\DTO\v1\PurchaseDTO;
use App\Enums\PurchaseStatus;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetails;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Throwable;

final class UpdatePurchase
{
    public function handle(string $id, PurchaseDTO $dto): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            DB::beginTransaction();

            $purchase = Purchase::query()->findOrFail($id);

            $purchase->update([
                'supplier_id'   => $dto->getSupplierId(),
                'date'          => $dto->getDate(),
                'total_amount'  => $dto->getTotalAmount(),
            ]);

            $currentProducts = $purchase->details()->pluck('product_id')->toArray();

            $newProducts = [];

            foreach ($dto->getProducts() as $product) {
                $existingDetail = PurchaseDetails::where('purchase_id', $purchase->id)
                    ->where('product_id', $product['product_id'])
                    ->first();

                if ($existingDetail) {
                    $existingDetail->update([
                        'quantity' => $product['quantity'],
                        'unit_cost' => $product['unit_cost'],
                        'total' => $product['quantity'] * $product['unit_cost'],
                    ]);
                } else {
                    if (!in_array($product['product_id'], $currentProducts)) {
                        $newProducts[] = [
                            'purchase_id' => $purchase->id,
                            'product_id' => $product['product_id'],
                            'quantity' => $product['quantity'],
                            'unit_cost' => $product['unit_cost'],
                            'total' => $product['quantity'] * $product['unit_cost'],
                            'created_at' => now(),
                            'company_id' => auth()->user()->current_company,
                        ];
                    }
                }
            }

            if (!empty($newProducts)) {
                PurchaseDetails::insert($newProducts);
            }

            DB::commit();

            return new ApiSuccessResponse(
                message: 'Achat modifié avec succès',
                data: $purchase,
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
