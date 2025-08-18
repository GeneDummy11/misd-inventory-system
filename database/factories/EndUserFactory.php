<?php

namespace Database\Factories;

use App\Models\Division;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EndUser>
 */
class EndUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'end_user_name' => fake()->word(),
            'division_id' => Division::factory(),
            'service_id' => Service::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
