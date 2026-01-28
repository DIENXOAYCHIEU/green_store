<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoleSeeder extends Seeder
{

	public function run(): void{
		DB::table('roles')->insert([
			[
				// 'id' => 1,
				'name' => 'USER',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				// 'id' => 2,
				'name' => 'ADMIN',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
		]);
	}
}
