<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

	public function up(): void
	{
		Schema::create('bills', function (Blueprint $table) {
            $table->id();
			$table->string('method');
            $table->string('status')->default('pending');
            $table->string('transaction_no')->nullable();
            $table->string('response_code')->nullable();
            $table->timestamps();

			$table->foreignId('order_id')
                ->constrained()
                ->cascadeOnDelete();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('bills');
	}
};
