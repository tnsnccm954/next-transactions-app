<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderStatuses = [
            [
                'name' => 'pending',
                'display_name' => 'Pending',
            ],
            [
                'name' => 'processing',
                'display_name' => 'Processing',
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

        foreach ($orderStatuses as $orderStatus) {
            \App\Models\OrderStatus::firstOrCreate(['name' => $orderStatus['name']], $orderStatus);
        }
    }
}
