<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

	public function up(): void
	{
		Schema::create('revenue_purchases', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('purchase_id');
			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('revenue_purchases');
	}
};
