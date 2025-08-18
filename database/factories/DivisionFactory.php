<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Division>
 */
class DivisionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'division_name' => fake()->word(),
            'division_description' => fake()->sentence(),
            'service_id' => Service::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
