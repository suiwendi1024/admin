<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cost = random_int(1, 10000) * 0.01;

        return [
            'name' => $this->faker->words(3, true),
            'description' => '<p>' . join('</p><p>', $this->faker->paragraphs(random_int(3, 6))) . '</p>',
            'price' => $cost * 1.2,
            'cost' => $cost,
            'stock' => random_int(1000, 10000),
            'is_available' => true,
            'available_from' => date('Y-m-d H:i:s'),
        ];
    }
}
