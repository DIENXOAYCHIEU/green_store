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
			$table->unsignedBigInteger('product_id');
			$table->unsignedBigInteger('order_id');
			$table->unsignedBigInteger('quantity');
			$table->unsignedBigInteger('total_price');			
			$table->timestamps();
			
			$table->foreign('product_id')
					->references('id')
					->on('products')
					->onDelete('restrict');

			$table->foreign('order_id')
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
