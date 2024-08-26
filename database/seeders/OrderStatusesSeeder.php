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
                'default_display_name' => 'Pending',
            ],
            [
                'name' => 'processing',
                'default_display_name' => 'Processing',
            ],
            [
                'name' => 'completed',
                'default_display_name' => 'Completed',
            ],
            [
                'name' => 'cancelled',
                'default_display_name' => 'Cancelled',
            ],
            [
                'name' => 'failed',
                'default_display_name' => 'Failed',
            ],
        ];

        foreach ($orderStatuses as $orderStatus) {
            \App\Models\OrderStatus::firstOrCreate(['name' => $orderStatus['name']], $orderStatus);
        }
    }
}
