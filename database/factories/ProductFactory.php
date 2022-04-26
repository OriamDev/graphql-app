<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->words($this->faker->numberBetween(3, 5), true);

        return [
            'category_id' => $this->faker->numberBetween(1, 10),
            'name' => $name,
            'slug' => Str::slug($name),
            'status' => 1,
            'price' => $this->faker->numberBetween(1000, 10000)
        ];
    }
}
