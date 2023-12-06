<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'item_name' => $this->faker->name,
            'category' => $this->faker->name,
            'description' => $this->faker->text(20),
            'price' => rand(20, 60),
            'item_photo' =>  fake()->imageUrl(),
            'owner_name' => $this->faker->name,
        ];
    }
}
