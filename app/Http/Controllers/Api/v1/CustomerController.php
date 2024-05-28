<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1;

use App\Actions\v1\Customer\DestroyCustomer;
use App\Actions\v1\Customer\FetchCustomers;
use App\Actions\v1\Customer\ShowCustomer;
use App\Actions\v1\Customer\StoreCustomer;
use App\Actions\v1\Customer\UpdateCustomer;
use App\DTO\v1\CustomerDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Customer\StoreCustomerRequest;
use App\Http\Requests\v1\Customer\UpdateCustomerRequest;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use App\Responses\v1\Customer\CustomerCollectionResponse;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FetchCustomers $action): CustomerCollectionResponse | ApiErrorResponse
    {
        return $action->handle();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request, StoreCustomer $action)
    {
        return $action->handle(CustomerDTO::fromRequest($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, ShowCustomer $action): ApiSuccessResponse | ApiErrorResponse
    {
        return $action->handle($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, string $id, UpdateCustomer $action)
    {
        return $action->handle($id, CustomerDTO::fromRequest($request));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, DestroyCustomer $action)
    {
        return $action->handle($id);
    }
}
