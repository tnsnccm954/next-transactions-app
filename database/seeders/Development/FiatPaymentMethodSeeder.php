<?php

namespace Database\Seeders\Development;

use App\Models\CurrencyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FiatPaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fiatCurrenyType = CurrencyType::firstOrCreate(['name' => 'fiat'], ['name' => 'fiat', 'default_display_name' => 'Fiat']);

        $paymentMethods = [
            [
                'name' => 'PayPal',
                'code' => 'paypal',
                'default_display_name' => 'PayPal',
                'is_active' => 1,
            ],
            [
                'name' => 'Stripe',
                'code' => 'stripe',
                'default_display_name' => 'Stripe',
                'is_active' => 1,
            ],
            [
                'name' => 'Bank Transfer',
                'code' => 'bank_transfer',
                'default_display_name' => 'Bank Transfer',
                'is_active' => 1,
            ],
        ];

        foreach ($paymentMethods as $paymentMethod) {
            $paymentMethod['currency_type_id'] = $fiatCurrenyType->id;
            \App\Models\PaymentMethod::firstOrCreate(['name' => $paymentMethod['name']], $paymentMethod);
        }
    }
}
