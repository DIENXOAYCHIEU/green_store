<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;

class AccountSeeder extends Seeder
{

	public function run(): void{

		DB::table('accounts')->insert([
			[
				'username' => 'test test',
				'phone' => '0123456789',
				'email' => 'example123@gmail.com',
				'password' => Hash::make('12345678'),
				'avatar' => 'avatar.png',
				'role_id' => 1,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				'username' => 'admin test test',
				'phone' => '0123456790',
				'email' => 'example123admin@gmail.com',
				'password' => Hash::make('12345678'),
				'avatar' => 'avatar.png',
				'role_id' => 2,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],

		]);

		// Account::factory()->count(20)->create();
	}
}
