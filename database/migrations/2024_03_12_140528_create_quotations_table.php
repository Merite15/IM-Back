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
        Schema::create('quotations', function (Blueprint $table): void {
            $table->comment('Table qui stocke les devis');
            $table->id();
            $table->date('date')->comment('Date du devis');
            $table->string('reference')->comment('Référence');
            $table->integer('tax_percentage')->default(0)->comment('Pourcentage de taxe');
            $table->integer('tax_amount')->default(0)->comment('Montant de la taxe');
            $table->integer('discount_percentage')->default(0)->comment('Pourcentage de remise');
            $table->integer('discount_amount')->default(0)->comment('Montant de la remise');
            $table->integer('shipping_amount')->default(0)->comment('Montant de la livraison');
            $table->integer('total_amount')->comment('Montant total');
            $table->text('note')->nullable()->comment('Note');
            $table->enum('status', OrderStatus::values())->comment('Statut');
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
        Schema::dropIfExists('quotations');
    }
};
