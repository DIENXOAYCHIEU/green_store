<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatusSeeder extends Seeder
{

	public function run(): void{
		$statuses = [
			[
				'id' => 1,
				'name' => 'Chờ xử lý',
			],
			[
				'id' => 2,
				'name' => 'Đã giao hàng',
			],
			[
				'id' => 3,
				'name' => 'Đã hủy',
			],
			[
				'id' => 4,
				'name' => 'Đã thanh toán',
			],
			[
				'id' => 5,
				'name' => 'Đang thanh toán',
			],
			[
				'id' => 6,
				'name' => 'Hoàn tất',
			]
		];

		foreach ($statuses as $status) {
			DB::table('statuses')->updateOrInsert(
				['id' => $status['id']],
				$status + ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
			);
		}
	}
}
