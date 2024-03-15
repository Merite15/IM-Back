<?php

declare(strict_types=1);

use App\Enums\OrderStatus;
use App\Models\Company;
use App\Models\Customer;
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
        Schema::create('orders', function (Blueprint $table): void {
            $table->id();
            $table->string('date');
            $table->enum('status', OrderStatus::values());
            $table->integer('total_products');
            $table->integer('sub_total');
            $table->integer('vat');
            $table->integer('total');
            $table->string('invoice_no');
            $table->string('payment_type');
            $table->integer('pay');
            $table->integer('due');
            $table->foreignIdFor(Customer::class)->constrained();
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
        Schema::dropIfExists('orders');
    }
};
