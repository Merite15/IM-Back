<?php

declare(strict_types=1);

use App\Enums\PurchaseStatus;
use App\Models\Company;
use App\Models\Supplier;
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
        Schema::create('purchases', function (Blueprint $table): void {
            $table->id();
            $table->string('date');
            $table->string('purchase_no');
            $table->integer('total_amount');
            $table->enum('gender', PurchaseStatus::values());
            $table->foreignIdFor(Supplier::class)->constrained();
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
        Schema::dropIfExists('purchases');
    }
};
