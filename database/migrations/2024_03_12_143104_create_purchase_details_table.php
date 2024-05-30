<?php

declare(strict_types=1);

use App\Models\Company;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchase_details', function (Blueprint $table): void {
            $table->comment('Table qui stocke les détails des achats');
            $table->id();
            $table->integer('quantity')->comment('Quantité');
            $table->integer('unit_cost')->comment('Coût unitaire');
            $table->integer('total')->comment('Total');
            $table->foreignIdFor(Purchase::class)->constrained();
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
        Schema::dropIfExists('purchase_details');
    }
};
