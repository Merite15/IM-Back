<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1;

use App\Actions\v1\Sale\DestroySale;
use App\Actions\v1\Sale\FetchSales;
use App\Actions\v1\Sale\ShowSale;
use App\Actions\v1\Sale\StoreSale;
use App\Actions\v1\Sale\UpdateSale;
use App\DTO\v1\SaleDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Sale\StoreSaleRequest;
use App\Http\Requests\v1\Sale\UpdateSaleRequest;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use App\Responses\v1\Sale\SaleCollectionResponse;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FetchSales $action): SaleCollectionResponse | ApiErrorResponse
    {
        return $action->handle();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request, StoreSale $action)
    {
        return $action->handle(SaleDTO::fromRequest($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, ShowSale $action): ApiSuccessResponse | ApiErrorResponse
    {
        return $action->handle($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, string $id, UpdateSale $action)
    {
        return $action->handle($id, SaleDTO::fromRequest($request));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, DestroySale $action)
    {
        return $action->handle($id);
    }
}
