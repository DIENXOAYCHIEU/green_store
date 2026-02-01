<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Image;

class ImageFactory extends Factory{
	protected $model = Image::class;

	public function definition(): array{
		return [
			'product_id'=>$this->faker->numberBetween(1,40),
			'path'=> 'products/onghuttre.jpg',
			'alt' => $this->faker->sentence(3),
		];
	}
}
