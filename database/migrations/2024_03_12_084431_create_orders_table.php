<?php

declare(strict_types=1);

use App\Enums\OrderStatus;
use App\Enums\PaymentType;
use App\Models\Company;
use App\Models\Customer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table): void {
            $table->comment('Table qui stocke les commandes');
            $table->id();
            $table->string('date')->comment('Date de la commande');
            $table->integer('total_products')->comment('Nombre total de produits');
            $table->integer('sub_total')->comment('Sous-total');
            $table->integer('vat')->comment('TVA');
            $table->integer('total')->comment('Total');
            $table->string('invoice_no')->comment('Numéro de facture')->nullable();
            $table->integer('pay')->comment('Montant payé');
            $table->integer('due')->comment('Montant dû');
            $table->enum('status', OrderStatus::values());
            $table->enum('payment_type', PaymentType::values());
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
