<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	use WithoutModelEvents;

	public function run(): void
	{

		$this->call(StatusSeeder::class);
		$this->call(RoleSeeder::class);
		$this->call(CategorySeeder::class);
		//$this->call(AccountSeeder::class);
		//$this->call(ProductSeeder::class);
		//$this->call(ImageSeeder::class);
		//$this->call(ReviewSeeder::class);
		$this->call(DemoSeeder::class);
	}
}
