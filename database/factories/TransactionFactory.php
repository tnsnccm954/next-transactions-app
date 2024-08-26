<?php

namespace Database\Factories;

use App\Models\TransactionState;
use App\Models\TransactionType;
use App\Models\User;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $expireDatetime = Carbon::now()->addMinutes(15);
        $starterTransactionType = TransactionType::firstOrCreate(['name' => 'deposit', 'default_display_name' => 'Deposit']);
        $starterTransactionState = TransactionState::firstOrCreate(['name' => 'pending', 'default_display_name' => 'Pending']);
        $actor = User::factory()->create();
        return [
            'transaction_type_id' => $starterTransactionType->id,
            'transaction_state_id' => $starterTransactionState->id,
            'sender_wallet_id' => Wallet::factory(['user_id' =>  $actor->id])->create()->id,
            'receiver_wallet_id' => Wallet::factory()->create()->id,
            'user_id' => User::factory()->create()->id, 
            'amount' => rand(1, 1000),
            'transaction_fee' => 0,
            'expires_at' => $expireDatetime,
        ];
    }
}
