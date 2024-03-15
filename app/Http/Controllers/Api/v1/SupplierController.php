<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1;

use App\Actions\v1\Supplier\DestroySupplier;
use App\Actions\v1\Supplier\FetchSuppliers;
use App\Actions\v1\Supplier\ShowSupplier;
use App\Actions\v1\Supplier\StoreSupplier;
use App\Actions\v1\Supplier\UpdateSupplier;
use App\DTO\v1\Supplier\SupplierDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Supplier\StoreSupplierRequest;
use App\Http\Requests\v1\Supplier\UpdateSupplierRequest;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use App\Responses\v1\Supplier\SupplierCollectionResponse;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FetchSuppliers $action): SupplierCollectionResponse | ApiErrorResponse
    {
        return $action->handle();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request, StoreSupplier $action)
    {
        return $action->handle(SupplierDTO::fromRequest($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, ShowSupplier $action): ApiSuccessResponse | ApiErrorResponse
    {
        return $action->handle($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, string $id, UpdateSupplier $action)
    {
        return $action->handle($id, SupplierDTO::fromRequest($request));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, DestroySupplier $action)
    {
        return $action->handle($id);
    }
}
