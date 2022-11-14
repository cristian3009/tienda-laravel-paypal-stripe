<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => 'Item ' . $this->faker->word(),
            'price' => 200,
            'description' => $this->faker->text(),
            'thumbnail' => 'https://picsum.photos/550/600'
        ];
    }
}
