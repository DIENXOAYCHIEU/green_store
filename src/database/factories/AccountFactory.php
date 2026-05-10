<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;

class AccountFactory extends Factory{
	protected $model = Account::class;

	public function definition(): array{
		return [
			'username' => $this->faker->name(),
			'phone' => $this->faker->unique()->numerify('##########'),
			'email' => $this->faker->unique()->safeEmail(),
			'password' => Hash::make('123456789'),
			'avatar' => 'default.png',
			'roleId' => 1,
		];
	}
}
