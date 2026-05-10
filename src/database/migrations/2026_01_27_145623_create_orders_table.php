<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

	public function up(): void
	{
		Schema::create('orders', function (Blueprint $table) {
			$table->string('id')->primary();
			$table->unsignedBigInteger('account_id');
			$table->unsignedBigInteger('receiver_id');
			$table->unsignedBigInteger('total_price');
			$table->text('note')->nullable();
			$table->unsignedBigInteger('status_id')->default(1);
			$table->string('payment_method')->default('cod');
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('account_id')
					->references('id')
					->on('accounts')
					->onDelete('restrict');

			$table->foreign('receiver_id')
					->references('id')
					->on('receivers')
					->onDelete('restrict');

			$table->foreign('status_id')
					->references('id')
					->on('statuses')
					->onDelete('restrict');

		});
	}

	public function down(): void
	{
		Schema::dropIfExists('orders');
	}
};
