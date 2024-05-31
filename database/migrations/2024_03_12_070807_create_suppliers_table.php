<?php

declare(strict_types=1);

use App\Enums\SupplierType;
use App\Models\Company;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table): void {
            $table->comment('Table qui stocke les fournisseurs');
            $table->id();
            $table->string('name')->comment('Nom du fournisseur');
            $table->string('email')->unique()->nullable()->comment('Email unique du fournisseur');
            $table->string('phone')->unique()->comment('Numéro de téléphone unique du fournisseur');
            $table->string('address')->nullable()->comment('Adresse du fournisseur');
            $table->string('shop_name')->comment('Nom du magasin du fournisseur');
            $table->string('city')->comment('Ville du fournisseur');
            $table->enum('type', SupplierType::values());
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
        Schema::dropIfExists('suppliers');
    }
};
