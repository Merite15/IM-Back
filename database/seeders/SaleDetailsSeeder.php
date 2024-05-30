<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\SaleDetails;
use Illuminate\Database\Seeder;

class SaleDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SaleDetails::factory()->count(10)->create();
    }
}
