<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencyTypeSeeder extends Seeder
{   
    public $created_at = "2024-08-22T06:19:24+00:00";
    public $updated_at = "2024-08-22T06:19:24+00:00";
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencyTypes = [
            [
                'name' => 'fiat',
                'default_display_name' => 'Fiat',
            ],
            [
                'name' => 'crypto',
                'default_display_name' => 'Crypto',
            ],
        ];

        foreach ($currencyTypes as $currencyType) {
            $currencyType['created_at'] = Carbon::now();
            $currencyType['updated_at'] = Carbon::now();
            \App\Models\CurrencyType::firstOrCreate(['name' => $currencyType['name']], $currencyType);
        }
    }
}
