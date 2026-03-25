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
			$table->string('phone')->unique()->nullable();
			$table->string('email')->unique();
			$table->string('password')->nullable();
			$table->string('avatar')->default('avatar.png');
			$table->unsignedBigInteger('role_id')->default(1);
			$table->timestamps();
			$table->rememberToken();
			$table->softDeletes();

			$table->foreign('role_id')
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
