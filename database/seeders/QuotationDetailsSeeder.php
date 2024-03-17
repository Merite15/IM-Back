<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\QuotationDetails;
use Illuminate\Database\Seeder;

class QuotationDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        QuotationDetails::factory()->count(10)->create();
    }
}
