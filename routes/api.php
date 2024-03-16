<?php

declare(strict_types=1);

use App\Actions\RunMigration;
use App\Http\Controllers\Api\v1\Auth\LoginController;
use App\Http\Controllers\Api\v1\Auth\LogoutController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\CompanyController;
use App\Http\Controllers\Api\v1\CustomerController;
use App\Http\Controllers\Api\v1\DashboardController;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\Api\v1\PurchaseController;
use App\Http\Controllers\Api\v1\SupplierController;
use App\Http\Controllers\Api\v1\UnitController;
use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/run-migration', fn () => RunMigration::handle());

Route::middleware('auth:sanctum')->get('/user', fn (Request $request) => $request->user());

Route::prefix('auth')->group(function (): void {
    Route::post('/login', LoginController::class)->name('login');
    Route::middleware('auth:sanctum')->delete('/logout', LogoutController::class)->name('logout');
});

Route::group(['middleware' => ['auth:sanctum']], function (): void {
    Route::prefix('products')->group(function () {
        Route::controller(ProductController::class)->group(function () {
            Route::get('import', 'import');
            Route::get('export-excel', 'exportExcel');
            Route::get('export-data', 'exportData');
        });
    });

    Route::prefix('purchases')->group(function () {
        Route::controller(PurchaseController::class)->group(function () {
            Route::get('export-report', 'exportPurchaseReport');
            Route::get('export-excel', 'exportExcel');
            Route::get('approved', 'approvedPurchases');
        });
    });

    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resources([
        'customers' => CustomerController::class,
        'companies' => CompanyController::class,
        'units' => UnitController::class,
        'suppliers' => SupplierController::class,
        'categories' => CategoryController::class,
        'purchase' => PurchaseController::class,
        'users' => UserController::class,
        'products' => ProductController::class,
    ], ['except' => ['edit', 'create']]);
});
