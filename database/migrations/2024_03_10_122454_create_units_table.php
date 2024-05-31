<?php

declare(strict_types=1);

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
        Schema::create('units', function (Blueprint $table): void {
            $table->comment('Table qui stocke les unités');
            $table->id();
            $table->string('name')->unique()->comment('Nom de l\'unité');
            $table->string('short_code')->unique()->comment('Code court de l\'unité');
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
        Schema::dropIfExists('units');
    }
};
