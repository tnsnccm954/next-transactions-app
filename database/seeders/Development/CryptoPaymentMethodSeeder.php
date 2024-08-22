<?php

namespace Database\Seeders\Development;

use App\Models\CurrencyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CryptoPaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cryptoCurrenyType = CurrencyType::firstOrCreate(['name' => 'crypto'], ['name' => 'crypto', 'default_display_name' => 'Crypto']);
        
        $paymentMethods = [
            [
                'name' => 'bnb',
                'code' => 'BNB',
                'default_display_name' => 'BNB',
                'is_active' => 1,
            ],
            [
                'name' => 'tron',
                'code' => 'tron',
                'default_display_name' => 'tron',
                'is_active' => 1,
            ],
        ];

        foreach ($paymentMethods as $paymentMethod) {
            $paymentMethod['currency_type_id'] = $cryptoCurrenyType->id;
            \App\Models\PaymentMethod::create($paymentMethod);
        }
        // Add any additional properties or relationships to the $cryptoPaymentMethod if needed

    }
}
