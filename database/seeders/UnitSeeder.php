<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = collect([
            [
                'name' => 'Meters',
                'slug' => 'meters',
                'short_code' => 'm',
                'company_id' => 1
            ],
            [
                'name' => 'Centimeters',
                'slug' => 'centimeters',
                'short_code' => 'cm',
                'company_id' => 1
            ],
            [
                'name' => 'Piece',
                'slug' => 'piece',
                'short_code' => 'pc',
                'company_id' => 1
            ]
        ]);

        $units->each(function ($unit): void {
            Unit::insert($unit);
        });
    }
}
