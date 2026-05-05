<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

	public function up(): void
	{
		Schema::create('revenue_accounts', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('account_id');
			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('revenue_accounts');
	}
};
