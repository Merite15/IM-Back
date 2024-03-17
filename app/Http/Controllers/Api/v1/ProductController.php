<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1;

use App\Actions\v1\Product\DestroyProduct;
use App\Actions\v1\Product\ExportExcel;
use App\Actions\v1\Product\FetchProducts;
use App\Actions\v1\Product\ImportExcel;
use App\Actions\v1\Product\ImportProduct;
use App\Actions\v1\Product\ShowProduct;
use App\Actions\v1\Product\StoreProduct;
use App\Actions\v1\Product\UpdateProduct;
use App\DTO\v1\Product\ImportProductDTO;
use App\DTO\v1\Product\ProductDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Product\ImportProductRequest;
use App\Http\Requests\v1\Product\StoreProductRequest;
use App\Http\Requests\v1\Product\UpdateProductRequest;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use App\Responses\v1\Product\ProductCollectionResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FetchProducts $action): ProductCollectionResponse | ApiErrorResponse
    {
        return $action->handle();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request, StoreProduct $action)
    {
        return $action->handle(ProductDTO::fromRequest($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, ShowProduct $action): ApiSuccessResponse | ApiErrorResponse
    {
        return $action->handle($id);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id, UpdateProduct $action)
    {
        return $action->handle($id, ProductDTO::fromRequest($request));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, DestroyProduct $action)
    {
        return $action->handle($id);
    }

    public function import(ImportProductRequest $request, ImportProduct $action)
    {
        return $action->handle(ImportProductDTO::fromRequest($request));
    }

    public function exportExcel(ExportExcel $action)
    {
        return $action->handle();
    }

    public function importExcel(ImportExcel $action)
    {
        return $action->handle();
    }
}
