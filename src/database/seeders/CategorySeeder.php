<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
	public function run(): void{
		DB::table('categories')->insert([
			[
				'id' => 1,
				'name' => 'RECYCLING',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				'id' => 2,
				'name' => 'INOX',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				'id' => 3,
				'name' => 'NATURE',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],

		]);
	}
}
