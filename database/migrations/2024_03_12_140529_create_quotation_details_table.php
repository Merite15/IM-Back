<?php

declare(strict_types=1);

use App\Models\Company;
use App\Models\Product;
use App\Models\Quotation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quotation_details', function (Blueprint $table): void {
            $table->comment('Table qui stocke les détails des devis');
            $table->id();
            $table->integer('quantity')->comment('Quantité');
            $table->integer('price')->comment('Prix');
            $table->integer('unit_price')->comment('Prix unitaire');
            $table->integer('sub_total')->comment('Sous-total');
            $table->integer('product_discount_amount')->comment('Montant de remise du produit');
            $table->string('product_discount_type')->default('fixed')->comment('Type de remise du produit');
            $table->integer('product_tax_amount')->comment('Montant de taxe du produit');
            $table->foreignIdFor(Quotation::class)->constrained();
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
        Schema::dropIfExists('quotation_details');
    }
};
