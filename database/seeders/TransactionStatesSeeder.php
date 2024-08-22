<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionStatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactionStates = [
            [
                'name' => 'pending',
                'display_name' => 'Pending',
            ],
            [
                'name' => 'completed',
                'display_name' => 'Completed',
            ],
            [
                'name' => 'cancelled',
                'display_name' => 'Cancelled',
            ],
            [
                'name' => 'failed',
                'display_name' => 'Failed',
            ],
        ];

        foreach ($transactionStates as $transactionState) {
            \App\Models\TransactionState::firstOrCreate(['name' => $transactionState['name']], $transactionState);
        }
    }
}
