<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory{

    public function definition(): array{
        return [
            'content' => $this->faker->sentence(100),
            'account_id' =>$this->faker->numberBetween(1,1),
            'product_id' =>$this->faker->numberBetween(1,40),
        ];
    }
}
