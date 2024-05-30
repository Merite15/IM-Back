<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table): void {
            $table->comment('table qui stocke les compagnies');
            $table->id();
            $table->string('name')->unique()->comment('Nom unique de la société');
            $table->string('address')->comment('Adresse de la société');
            $table->string('phone')->unique()->comment('Numéro de téléphone unique de la société');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
