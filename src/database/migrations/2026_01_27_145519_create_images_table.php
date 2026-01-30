<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

	public function up(): void
	{
		Schema::create('images', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('product_id');
			$table->string('path');
			$table->string('alt');
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('product_id')
					->references('id')
					->on('products')
					->onDelete('restrict');
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('images');
	}
};
