<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\PurchaseDetails;
use Illuminate\Database\Seeder;

class PurchaseDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PurchaseDetails::factory()->count(10)->create();
    }
}
