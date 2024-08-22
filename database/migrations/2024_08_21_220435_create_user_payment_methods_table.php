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
        Schema::create('user_payment_methods', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_id')->constrained('users','id')->onDelete('cascade');
            $table->foreignId('payment_method_id')->constrained('payment_methods','id')->onDelete('cascade');
            $table->string('display_name',255);
            $table->string('account_holder_name',255);
            $table->json('account_details');
            $table->boolean('is_default')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_payment_methods');
    }
};
