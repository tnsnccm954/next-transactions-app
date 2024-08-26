<?php

namespace Database\Factories;

use App\Models\Currency;
use App\Models\OrderStatus;
use App\Models\OrderType;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        $quantity = random_int(1,9999999);
        $price = random_int(1, $quantity);
        $min = random_int(1,$quantity);
        $max = random_int($min,$quantity);
        $starterOrderStatus = OrderStatus::where(['name'=>'pending'])->exists()  ? OrderStatus::where(['name'=>'pending'])->first() : OrderStatus::factory()->create(['name'=>'pending','default_display_name'=>'Pending']);    
        $starterOrderType = OrderType::where(['name'=>'buy'])->exists()  ? OrderType::where(['name'=>'buy'])->first() : OrderType::factory()->create(['name'=>'buy','default_display_name'=>'Buy']);
        return [
            'order_type_id' => $starterOrderType->id,
            'order_status_id' =>  $starterOrderStatus->id,
            'payment_method_id' => PaymentMethod::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'from_currency_id' => Currency::factory()->create()->id,
            'to_currency_id'=> Currency::factory()->create()->id,
            'quantity' => $quantity,
            'price' => $price,
            'maximum' => $max,
            'minimum' => $min,
            'limit_transaction_time' => random_int(1,300),
        ];
    }
}
