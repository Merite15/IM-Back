<?php

declare(strict_types=1);

use App\Actions\RunMigration;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\CompanyController;
use App\Http\Controllers\Api\v1\CustomerController;
use App\Http\Controllers\Api\v1\DashboardController;
use App\Http\Controllers\Api\v1\OrderController;
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

Route::get('/run-migration', fn() => RunMigration::handle());

Route::middleware('auth:sanctum')->get('/user', fn(Request $request) => $request->user());

Route::prefix('auth')->group(function (): void {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::middleware('auth:sanctum')->delete('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => ['auth:sanctum']], function (): void {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::prefix('products')->group(function (): void {
        Route::controller(ProductController::class)->group(function (): void {
            Route::get('import', 'import');
            Route::get('export-excel', 'exportExcel');
        });
    });

    Route::prefix('purchases')->group(function (): void {
        Route::controller(PurchaseController::class)->group(function (): void {
            Route::get('export-report', 'exportPurchaseReport');
            Route::get('export-excel', 'exportExcel');
            Route::get('approved', 'getApprovedPurchases');
        });
    });

    Route::prefix('orders')->group(function (): void {
        Route::controller(OrderController::class)->group(function (): void {
            Route::get('pending', 'getPendingOrders');
            Route::get('due', 'getDueOrders');
            Route::put('pay-due-order/{order}', 'payDueOrder');
            Route::get('complete', 'getCompleteOrders');
        });
    });

    Route::resources([
        'customers' => CustomerController::class,
        'companies' => CompanyController::class,
        'units' => UnitController::class,
        'suppliers' => SupplierController::class,
        'categories' => CategoryController::class,
        'purchase' => PurchaseController::class,
        'users' => UserController::class,
        'products' => ProductController::class,
        'orders' => OrderController::class,
    ], ['except' => ['create', 'edit']]);
});
