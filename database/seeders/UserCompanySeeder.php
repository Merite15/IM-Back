<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\UserCompany;
use Illuminate\Database\Seeder;

class UserCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserCompany::factory()->count(5)->create();
    }
}
