<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->name(),
			'price' => $this->faker->numberBetween(1000, 10000),
			'image' => $this->faker->text(100),
        ];
    }
}
