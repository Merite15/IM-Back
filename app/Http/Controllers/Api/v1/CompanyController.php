<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\v1\Company\DestroyCompany;
use App\Actions\v1\Company\FetchCompanies;
use App\Actions\v1\Company\ShowCompany;
use App\Actions\v1\Company\StoreCompany;
use App\Actions\v1\Company\UpdateCompany;
use App\DTO\v1\Company\CompanyDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Company\StoreCompanyRequest;
use App\Http\Requests\v1\Company\UpdateCompanyRequest;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use App\Responses\v1\Company\CompanyCollectionResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FetchCompanies $action): CompanyCollectionResponse | ApiErrorResponse
    {
        return $action->handle();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request, StoreCompany $action)
    {
        return $action->handle(CompanyDTO::fromRequest($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, ShowCompany $action): ApiSuccessResponse | ApiErrorResponse
    {
        return $action->handle($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, string $id, UpdateCompany $action)
    {
        return $action->handle($id, CompanyDTO::fromRequest($request));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, DestroyCompany $action)
    {
        return $action->handle($id);
    }
}
