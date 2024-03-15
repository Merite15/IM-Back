<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1;

use App\Actions\v1\Category\DestroyCategory;
use App\Actions\v1\Category\FetchCategories;
use App\Actions\v1\Category\ShowCategory;
use App\Actions\v1\Category\StoreCategory;
use App\Actions\v1\Category\UpdateCategory;
use App\DTO\v1\Category\CategoryDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Category\StoreCategoryRequest;
use App\Http\Requests\v1\Category\UpdateCategoryRequest;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use App\Responses\v1\Category\CategoryCollectionResponse;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FetchCategories $action): CategoryCollectionResponse | ApiErrorResponse
    {
        return $action->handle();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request, StoreCategory $action)
    {
        return $action->handle(CategoryDTO::fromRequest($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, ShowCategory $action): ApiSuccessResponse | ApiErrorResponse
    {
        return $action->handle($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id, UpdateCategory $action)
    {
        return $action->handle($id, CategoryDTO::fromRequest($request));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, DestroyCategory $action)
    {
        return $action->handle($id);
    }
}
