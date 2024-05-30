<?php

declare(strict_types=1);

use App\Models\Company;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sale_details', function (Blueprint $table): void {
            $table->comment('Table qui stocke les détails des ventes en magasin');
            $table->id();
            $table->integer('quantity')->comment('Quantité vendue');
            $table->integer('unit_price')->comment('Prix unitaire');
            $table->integer('total')->comment('Total');
            $table->foreignIdFor(Sale::class)->constrained();
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
        Schema::dropIfExists('sale_details');
    }
};
