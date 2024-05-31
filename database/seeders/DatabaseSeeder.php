<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            CompanySeeder::class,
            UserSeeder::class,
            CustomerSeeder::class,
            SupplierSeeder::class,
            CategorySeeder::class,
            UnitSeeder::class,
            ProductSeeder::class,
            QuotationSeeder::class,
            QuotationDetailsSeeder::class,
            OrderSeeder::class,
            OrderDetailsSeeder::class,
            PurchaseSeeder::class,
            PurchaseDetailsSeeder::class,
            SaleSeeder::class,
            // SaleDetailsSeeder::class,
        ]);
    }
}
