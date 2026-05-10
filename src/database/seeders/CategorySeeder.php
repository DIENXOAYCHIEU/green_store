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
				'name' => 'Tái chế',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				'id' => 2,
				'name' => 'Thiên nhiên',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				'id' => 3,
				'name' => 'Tự hủy',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],

		]);
	}
}
