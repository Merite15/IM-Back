<?php

declare(strict_types=1);

use App\Enums\UserGender;
use App\Models\Company;
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
        Schema::create('customers', function (Blueprint $table): void {
            $table->comment('Table qui stocke les clients');
            $table->id();
            $table->string('name')->comment('Nom du client');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique()->comment('Numéro de téléphone unique du client');
            $table->string('address')->nullable()->comment('Adresse du client');
            $table->string('shop_name')->nullable()->comment('Nom du magasin du client');
            $table->string('city')->comment('Ville du client');
            $table->enum('gender', UserGender::values());
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
        Schema::dropIfExists('customers');
    }
};
