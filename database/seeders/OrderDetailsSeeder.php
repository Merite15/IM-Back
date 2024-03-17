<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\OrderDetails;
use Illuminate\Database\Seeder;

class OrderDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderDetails::factory()->count(10)->create();
    }
}
