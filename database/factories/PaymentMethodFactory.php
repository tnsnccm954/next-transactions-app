<?php

namespace Database\Factories;

use App\Models\CurrencyType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentMethod>
 */
class PaymentMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'currency_type_id' => CurrencyType::factory()->create()->id,
            'name' => fake()->name(),
            'code'=> str()->random(5),
            'default_display_name' => fake()->name(),
            'description'=> fake()->sentence(),
            'is_active' => true,
            'transaction_fee' => fake()->randomFloat(2, 0, 100),
        ];
    }
}
