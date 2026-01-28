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
			$table->unsignedBigInteger('weight');
			$table->text('description');
			$table->unsignedTinyInteger('discount');
			$table->unsignedBigInteger('totalPrice');
			$table->unsignedBigInteger('categoryId');
			$table->unsignedBigInteger('inventoryQuantity');
			$table->unsignedBigInteger('soldQuantity');
			$table->boolean('isdelete')->default(false);
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('categoryId')
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
