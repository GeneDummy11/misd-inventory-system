<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Arrangement>
 */
class ArrangementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'arrangement_name' => fake()->word(),
            'arrangement_description' => fake()->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
