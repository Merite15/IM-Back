<?php

declare(strict_types=1);

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
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('code');
            $table->integer('quantity');
            $table->integer('buying_price')->comment('Buying Price');
            $table->integer('selling_price')->comment('Selling Price');
            $table->integer('quantity_alert');
            $table->integer('tax')->nullable();
            $table->tinyInteger('tax_type')->nullable();
            $table->text('notes')->nullable();
            $table->string('product_image')->nullable();
            $table->foreignIdFor(Category::class)->nullable();
            $table->foreignIdFor(Unit::class);
            $table->foreignIdFor(Company::class);
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
