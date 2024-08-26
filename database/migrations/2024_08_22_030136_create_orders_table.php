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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users', 'id');
            $table->foreignId('order_status_id')->constrained('order_statuses', 'id');
            $table->foreignId('order_type_id')->constrained('order_types', 'id');
            $table->foreignId('payment_method_id')->constrained('payment_methods', 'id');
            $table->foreignId('from_currency_id')->constrained('currencies', 'id');
            $table->foreignId('to_currency_id')->constrained('currencies', 'id');

            $table->decimal('price', 16, 2);
            $table->decimal('quantity', 16, 2);
            $table->decimal('minimum', 16, 2)->default(0.01);
            $table->decimal('maximum', 16, 2)->nullable();
            $table->integer('limit_transaction_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
