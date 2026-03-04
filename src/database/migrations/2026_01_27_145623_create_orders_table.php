<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

	public function up(): void
	{
		Schema::create('orders', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('account_id');
			$table->unsignedBigInteger('sender_id');
			$table->unsignedBigInteger('promotion_id');
			$table->unsignedBigInteger('receiver_id');
			$table->unsignedBigInteger('price');
			$table->unsignedBigInteger('total_price');
			$table->unsignedBigInteger('total_weight');
			$table->text('note');
			$table->unsignedBigInteger('status_id')->default(1);
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('account_id')
					->references('id')
					->on('accounts')
					->onDelete('restrict');

			$table->foreign('sender_id')
					->references('id')
					->on('senders')
					->onDelete('restrict');

			$table->foreign('promotion_id')
					->references('id')
					->on('promotions')
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
