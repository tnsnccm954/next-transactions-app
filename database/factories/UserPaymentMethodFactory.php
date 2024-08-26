<?php

namespace Database\Factories;

use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserPaymentMethod>
 */
class UserPaymentMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create()->id,
            'payment_method_id' => PaymentMethod::factory()->create()->id,
            'wallet_id' => null,
            'display_name' => fake()->name(),
            'account_holder_name' => fake()->name(),
            'account_details' => fake()->sentence(),
            'is_default' => false,
            'is_active' => true,
        ];
    }
}
