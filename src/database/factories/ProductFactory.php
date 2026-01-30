<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductFactory extends Factory{
	protected $model = Product::class;

	public function definition(): array{
		return [
				'name' => $this->faker->unique()->word(),
				'price' => $this->faker->numberBetween(10000,1000000000),
				'picture' => 'products/onghuttre.jpg',
				'weight' => $this->faker->numberBetween(10000,1000000000),
				'description' => $this->faker->sentence(10),
				'discount'=> $this->faker->numberBetween(0,100),
				'total_price'=> function(array $att){
					return $att['price'] - ($att['price']*$att['discount']/100);
				},
				'category_id'=> $this->faker->numberBetween(1,3),
				'inventory_quantity' => $this->faker->numberBetween(1,100),
				'sold_quantity' => $this->faker->numberBetween(1,100),
				'is_delete' => false,
				];
	}
}
