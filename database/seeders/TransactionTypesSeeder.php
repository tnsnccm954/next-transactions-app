<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactionTypes = [
            [
                'name' => 'deposit',
                'default_display_name' => 'Deposit',
            ],
            [
                'name' => 'withdrawal',
                'default_display_name' => 'Withdrawal',
            ],
            [
                'name' => 'transfer',
                'default_display_name' => 'Transfer',
            ],
        ];

        foreach ($transactionTypes as $transactionType) {
            \App\Models\TransactionType::firstOrCreate(['name' => $transactionType['name']], $transactionType);
        }
    }
}
