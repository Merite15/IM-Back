<?php

declare(strict_types=1);

use App\Enums\PurchaseStatus;
use App\Models\Company;
use App\Models\Supplier;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table): void {
            $table->comment('Table qui stocke les achats');
            $table->id();
            $table->string('date')->comment('Date de l\'achat');
            $table->string('purchase_no')->comment('Numéro d\'achat')->nullable();
            $table->integer('total_amount')->comment('Montant total');
            $table->enum('status', PurchaseStatus::values())->default(PurchaseStatus::Pending->value)->comment('Statut de l\'achat');
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
