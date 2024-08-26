<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users','id');
            $table->foreignId('transaction_type_id')->constrained('transaction_types','id');
            $table->foreignId('transaction_state_id')->constrained('transaction_states','id');
            // we will know currency from wallet
            $table->foreignUuid('sender_wallet_id ')->constrained('wallets','id')->onDelete('no action');
            $table->foreignUuid('receiver_wallet_id')->constrained('wallets','id')->nulable()->onDelete('no action');

            $table->decimal('transaction_fee', 16, 2)->nullable()->default(null);
            $table->decimal('amount', 16, 2);

            // $table->dateTimeTz('started_at');
            $table->dateTimeTz('expires_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
