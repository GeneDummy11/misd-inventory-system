<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\DeviceType;
use App\Models\Status;
use App\Models\Supplier;
use App\Models\Arrangement;
use App\Models\Brand;
use App\Models\EndUser;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'device_name' => fake()->word(),
            'device_model' => fake()->word(),
            'device_description' => fake()->sentence(),
            'device_serial_number' => fake()->unique()->word(),
            'device_property_number' => fake()->unique()->word(),
            'device_delivery_date' => fake()->dateTimeBetween('-1 years', 'now'),
            'device_aquisition_cost' => fake()->randomFloat(2, 1, 1000),
            'device_remarks' => fake()->sentence(),
            'device_deployment_date' => fake()->dateTimeBetween('-1 years', 'now'),
            'end_user_id' => EndUser::factory(),
            'device_type_id' => DeviceType::factory(),
            'brand_id' => Brand::factory(),
            'status_id' => Status::factory(),
            'supplier_id' => Supplier::factory(),
            'arrangement_id' => Arrangement::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
