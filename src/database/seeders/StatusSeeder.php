<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatusSeeder extends Seeder
{

	public function run(): void{
		DB::table('statuses')->insert([
			[
				// 'id' => 1,
				'name' => 'PROCESSING',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				// 'id' => 2,
				'name' => 'SHIPPING',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				// 'id' => 3,
				'name' => 'CANCELED',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				// 'id' => 4,
				'name' => 'PAID',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],

		]);
	}
}
