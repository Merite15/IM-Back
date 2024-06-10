<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1;

use App\Actions\v1\Purchase\DestroyPurchase;
use App\Actions\v1\Purchase\ExportPurchaseExcel;
use App\Actions\v1\Purchase\ExportPurchaseReport;
use App\Actions\v1\Purchase\FetchApprovedPurchases;
use App\Actions\v1\Purchase\FetchPurchases;
use App\Actions\v1\Purchase\PurchaseReport;
use App\Actions\v1\Purchase\ShowPurchase;
use App\Actions\v1\Purchase\StorePurchase;
use App\Actions\v1\Purchase\UpdatePurchase;
use App\DTO\v1\ExportDateDTO;
use App\DTO\v1\PurchaseDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Purchase\ExportPurchaseRequest;
use App\Http\Requests\v1\Purchase\StorePurchaseRequest;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use App\Responses\v1\Purchase\PurchaseCollectionResponse;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FetchPurchases $action): PurchaseCollectionResponse | ApiErrorResponse
    {
        return $action->handle();
    }

    public function purchaseReport(PurchaseReport $action)
    {
        return $action->handle();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseRequest $request, StorePurchase $action)
    {
        return $action->handle(PurchaseDTO::fromRequest($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, ShowPurchase $action): ApiSuccessResponse | ApiErrorResponse
    {
        return $action->handle($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id, UpdatePurchase $action)
    {
        return $action->handle($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, DestroyPurchase $action)
    {
        return $action->handle($id);
    }

    public function exportExcel(ExportPurchaseExcel $action)
    {
        return $action->handle();
    }
}
