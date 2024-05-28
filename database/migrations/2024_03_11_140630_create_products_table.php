<?php

declare(strict_types=1);

use App\Enums\TaxType;
use App\Models\Category;
use App\Models\Company;
use App\Models\Unit;
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
        Schema::create('products', function (Blueprint $table): void {
            $table->comment('Table qui stocke les produits');
            $table->id();
            $table->string('name')->comment('Nom du produit');
            $table->string('code')->comment('Code du produit');
            $table->integer('quantity')->comment('Quantité du produit');
            $table->integer('buying_price')->comment('Prix d\'achat');
            $table->integer('selling_price')->comment('Prix de vente');
            $table->integer('quantity_alert')->comment('Alerte de quantité');
            $table->text('notes')->nullable()->comment('Notes');
            $table->string('image')->nullable()->comment('Image');
            $table->foreignIdFor(Category::class)->constrained();
            $table->foreignIdFor(Unit::class)->constrained();
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
        Schema::dropIfExists('products');
    }
};
