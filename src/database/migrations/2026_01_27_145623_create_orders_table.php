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
			$table->unsignedBigInteger('senderId');
			$table->unsignedBigInteger('promotionId');
			$table->unsignedBigInteger('receiverId');
			$table->unsignedBigInteger('price');
			$table->unsignedBigInteger('totalPrice');
			$table->unsignedBigInteger('totalWeight');
			$table->text('note');
			$table->unsignedBigInteger('statusId')->default(1);
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('senderId')
					->references('id')
					->on('senders')
					->onDelete('restrict');

			$table->foreign('promotionId')
					->references('id')
					->on('promotions')
					->onDelete('restrict');

			$table->foreign('receiverId')
					->references('id')
					->on('receivers')
					->onDelete('restrict');

			$table->foreign('statusId')
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
