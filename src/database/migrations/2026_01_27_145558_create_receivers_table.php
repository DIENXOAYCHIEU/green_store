<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

	public function up(): void
	{
		Schema::create('receivers', function (Blueprint $table) {
			$table->id();
			$table->string('fullname');
			$table->string('phone');
			$table->string('province');
			$table->string('district');
			$table->string('ward');
			$table->text('fullAddress');
			$table->boolean('isSupplier')->default(false);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('receivers');
	}
};
