<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\v1\Order\FetchCompleteOrders;
use App\Actions\v1\Order\FetchDueOrders;
use App\Actions\v1\Order\FetchOrders;
use App\Actions\v1\Order\FetchPendingOrders;
use App\Actions\v1\Order\PayDueOrder;
use App\DTO\v1\Order\PayOrderDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Order\PayOrderRequest;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use App\Responses\v1\Order\OrderCollectionResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FetchOrders $action): OrderCollectionResponse | ApiErrorResponse
    {
        return $action->handle();
    }

    public function getCompleteOrders(FetchCompleteOrders $action): OrderCollectionResponse | ApiErrorResponse
    {
        return $action->handle();
    }

    public function getPendingOrders(FetchPendingOrders $action): OrderCollectionResponse | ApiErrorResponse
    {
        return $action->handle();
    }

    public function getDueOrders(FetchDueOrders $action): OrderCollectionResponse | ApiErrorResponse
    {
        return $action->handle();
    }

    public function payDueOrder(PayOrderRequest $request, string $id, PayDueOrder $action): ApiSuccessResponse | ApiErrorResponse
    {
        return $action->handle($id, PayOrderDTO::fromRequest($request));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
