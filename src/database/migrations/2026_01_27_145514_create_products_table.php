<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		Schema::create('products', function (Blueprint $table) {
			$table->id();
			$table->string('name')->unique();
			$table->unsignedBigInteger('price');
			$table->string('picture');
			$table->text('description');
			$table->unsignedBigInteger('category_id');
			$table->unsignedBigInteger('inventory_quantity');
			$table->unsignedBigInteger('sold_quantity')->default(0);
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('category_id')
					->references('id')
					->on('categories')
					->onDelete('restrict');
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('products');
	}
};
