<?php

namespace App\Http\Controllers\Api\v1\Order;

use App\Actions\v1\Order\FetchCompleteOrders;
use App\Http\Controllers\Controller;
use App\Responses\ApiErrorResponse;
use App\Responses\v1\Order\OrderCollectionResponse;
use Illuminate\Http\Request;

class CompleteOrderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(FetchCompleteOrders $action): OrderCollectionResponse | ApiErrorResponse
    {
        return $action->handle();
    }
}
