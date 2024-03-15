<?php

declare(strict_types=1);

use App\Models\Company;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_details', function (Blueprint $table): void {
            $table->id();
            $table->integer('quantity');
            $table->integer('unit_cost');
            $table->integer('total');
            $table->foreignIdFor(Order::class)->constrained();
            $table->foreignIdFor(Product::class)->constrained();
            $table->foreignIdFor(Company::class)->constrained();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
