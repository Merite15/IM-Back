<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1;

use App\Actions\v1\Unit\DestroyUnit;
use App\Actions\v1\Unit\FetchUnits;
use App\Actions\v1\Unit\ShowUnit;
use App\Actions\v1\Unit\StoreUnit;
use App\Actions\v1\Unit\UpdateUnit;
use App\DTO\v1\Unit\UnitDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Unit\StoreUnitRequest;
use App\Http\Requests\v1\Unit\UpdateUnitRequest;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use App\Responses\v1\Unit\UnitCollectionResponse;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FetchUnits $action): UnitCollectionResponse | ApiErrorResponse
    {
        return $action->handle();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUnitRequest $request, StoreUnit $action)
    {
        return $action->handle(UnitDTO::fromRequest($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, ShowUnit $action): ApiSuccessResponse | ApiErrorResponse
    {
        return $action->handle($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUnitRequest $request, string $id, UpdateUnit $action)
    {
        return $action->handle($id, UnitDTO::fromRequest($request));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, DestroyUnit $action)
    {
        return $action->handle($id);
    }
}
