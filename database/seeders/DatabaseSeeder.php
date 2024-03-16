<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Supplier;
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
            QuotationSeeder::class,
            // QuotationDetailsSeeder::class,
            OrderSeeder::class,
            // OrderDetailsSeeder::class,
            PurchaseSeeder::class,
            // PurchaseDetailsSeeder::class,
            ProductSeeder::class
        ]);

        Customer::factory(15)->create();
        Supplier::factory(15)->create();
    }
}
