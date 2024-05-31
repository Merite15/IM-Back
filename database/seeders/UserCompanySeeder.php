<?php

namespace Database\Seeders;

use App\Models\UserCompany;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
