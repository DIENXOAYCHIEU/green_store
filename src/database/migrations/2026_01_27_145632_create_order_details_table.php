<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

	public function up(): void
	{
		Schema::create('order_details', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('productId');
			$table->unsignedBigInteger('orderId');
			$table->unsignedBigInteger('quantity');
			$table->unsignedBigInteger('totalWeight');
			$table->unsignedBigInteger('totalPrice');			

			$table->foreign('productId')
					->references('id')
					->on('products')
					->onDelete('restrict');

			$table->foreign('orderId')
					->references('id')
					->on('orders')
					->onDelete('restrict');
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('order_details');
	}
};
