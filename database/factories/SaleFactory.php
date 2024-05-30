<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\PaymentType;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->date(),
            'receipt_no' => $this->faker->unique()->numerify('REC-#####'),
            'total_amount' => $this->faker->numberBetween(1000, 50000),
            'payment_type' => $this->faker->randomElement(PaymentType::values()),
            'company_id' => Company::all()->random()->id,
        ];
    }
}
