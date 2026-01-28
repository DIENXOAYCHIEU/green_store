<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

	public function up(): void
	{
		Schema::create('accounts', function (Blueprint $table) {
			$table->id();
			$table->string('username')->unique();
			$table->string('phone')->unique();
			$table->string('email')->unique();
			$table->string('password');
			$table->string('avatar');
			$table->unsignedBigInteger('roleId')->default(1);
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('roleId')
					->references('id')
					->on('roles')
					->onDelete('restrict');

		});
	}

	public function down(): void
	{
		Schema::dropIfExists('accounts');
	}
};
