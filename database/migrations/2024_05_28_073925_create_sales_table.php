<?php

use App\Enums\PaymentType;
use App\Models\Company;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table): void {
            $table->comment('Table qui stocke les ventes en magasin');
            $table->id();
            $table->date('date')->comment('Date de la vente');
            $table->string('receipt_no')->comment('Numéro de reçu')->nullable();
            $table->integer('total_amount')->comment('Montant total de la vente');
            $table->enum('payment_type', PaymentType::values())->comment('Type de paiement');
            $table->foreignIdFor(Company::class)->constrained()->comment('Identifiant de la société associée');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
