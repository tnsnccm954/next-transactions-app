<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderTypes = [
            [
                'name' => 'buy',
                'display_name' => 'Buy',
            ],
            [
                'name' => 'sell',
                'display_name' => 'Sell',
            ],
        ];
        
        foreach ($orderTypes as $orderType) {
            \App\Models\OrderType::firstOrCreate(['name' => $orderType['name']], $orderType);
        }
    }
}
