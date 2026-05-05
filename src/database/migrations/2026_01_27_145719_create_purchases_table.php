<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

	public function up(): void
	{
		Schema::create('purchases', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('order_id');
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('order_id')
					->references('id')
					->on('orders')
					->onDelete('restrict');
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('purchases');
	}
};
