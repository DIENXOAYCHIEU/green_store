<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

	public function up(): void
	{
		Schema::create('bills', function (Blueprint $table) {
            $table->id();
			$table->string('method');
            $table->string('status')->default('pending');
			$table->string('bank_code')->nullable();
			$table->unsignedBigInteger('amount');
            $table->string('transaction_no')->nullable();
            $table->string('response_code')->nullable();
			$table->timestamp('paid_at')
                ->nullable();
            $table->timestamps();
			$table->string('order_id');
			$table->foreign('order_id')
				->references('id')
				->on('orders')
				->cascadeOnDelete();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('bills');
	}
};
