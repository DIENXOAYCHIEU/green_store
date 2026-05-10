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
        Schema::create('vnpay_payment_requests', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('vnp_txn_ref');
            $table->string('vnp_amount');
            $table->string('vnp_bank_code')->nullable();
            $table->string('vnp_transaction_no')->nullable();
            $table->string('vnp_response_code');
            $table->json('vnp_data'); // Store all VNPay data
            $table->boolean('processed')->default(false);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vnpay_payment_requests');
    }
};
