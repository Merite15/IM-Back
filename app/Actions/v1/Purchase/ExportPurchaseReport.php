<?php

declare(strict_types=1);

namespace App\Actions\v1\Purchase;

use App\DTO\v1\Export\ExportDateDTO;
use App\Responses\ApiErrorResponse;
use App\Responses\v1\Purchase\PurchaseCollectionResponse;
use Illuminate\Support\Facades\DB;
use Throwable;

final class ExportPurchaseReport
{
    public function handle(ExportDateDTO $dto): ApiErrorResponse | PurchaseCollectionResponse
    {
        try {
            $data = $dto->toArray();

            $purchases = DB::table('purchase_details')
                ->join('products', 'purchase_details.product_id', '=', 'products.id')
                ->join('purchases', 'purchase_details.purchase_id', '=', 'purchases.id')
                ->join('users', 'users.id', '=', 'purchases.created_by')
                ->whereBetween('purchases.updated_at', [$data['start_date'], $data['end_date']])
                ->where('purchases.status', '1')
                ->select(
                    'purchases.purchase_no',
                    'purchases.updated_at',
                    'purchases.supplier_id',
                    'products.code',
                    'products.name',
                    'purchase_details.quantity',
                    'purchase_details.unit_cost',
                    'purchase_details.total',
                    'users.name as created_by'
                )
                ->get();

            $purchase_array[] = array(
                'Date',
                'No Purchase',
                'Supplier',
                'Product Code',
                'Product',
                'Quantity',
                'Unit Cost',
                'Total',
                'Created By'
            );

            foreach ($purchases as $purchase) {
                $purchase_array[] = array(
                    'Date' => $purchase->updated_at,
                    'No Purchase' => $purchase->purchase_no,
                    'Supplier' => $purchase->supplier_id,
                    'Product Code' => $purchase->code,
                    'Product' => $purchase->name,
                    'Quantity' => $purchase->quantity,
                    'Unit Cost' => $purchase->unit_cost,
                    'Total' => $purchase->total,
                    'Created By' => $purchase->created_by
                );
            }

            $this->exportExcel($purchase_array);
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception
            );
        }
    }
}
