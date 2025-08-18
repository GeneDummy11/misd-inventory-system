<?php

namespace Database\Seeders;

use App\Models\Arrangement;
use App\Models\Brand;
use App\Models\Device;
use App\Models\DeviceType;
use App\Models\Division;
use App\Models\EndUser;
use App\Models\Service;
use App\Models\Status;
use App\Models\Supplier;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //Generate services based on the list below
        $services =  [
            ['service_name' => 'CBKMS', 'service_description' => 'Capacity Building and Knowledge Management Service'],
            ['service_name' => 'PDS', 'service_description' => 'Project Development Service'],
            ['service_name' => 'LS', 'service_description' => 'Legal Service'],
            ['service_name' => 'OED', 'service_description' => 'Office of the Executive Director'],
        ];

        foreach ($services as $service) {
            Service::factory()->count(1)->create([
                'service_name' => $service['service_name'],
                'service_description' => $service['service_description'],
            ]);
        }

        //Generate divisions based on the list below
        $divisions =  [
            ['division_name' => 'MISD', 'division_description' => 'Management Information Systems Division', 'service_id' => '1'],
            ['division_name' => 'SD', 'division_description' => 'Social Division', 'service_id' => '2'],
            ['division_name' => 'IAD', 'division_description' => 'Internal Advisory Division', 'service_id' => '3'],
            ['division_name' => 'CPDD', 'division_description' => 'Corporate Planning and Development Division', 'service_id' => '4'],
        ];

        foreach ($divisions as $division) {
            Division::factory()->count(1)->create([
                'division_name' => $division['division_name'],
                'division_description' => $division['division_description'],
                'service_id' => $division['service_id'],
            ]);
        }

        // Generate 4 end_users based on the list below, each associated with a random existing data
        $end_users =  [
            ['end_user_name' => 'Genesis Esquilona'],
            ['end_user_name' => 'Angelo James Campollo'],
            ['end_user_name' => 'Arvy Maldecir'],
            ['end_user_name' => 'Richard Maclang'],
        ];

        foreach ($end_users as $end_user) {
            EndUser::factory()->count(1)->create([
                'end_user_name' => $end_user['end_user_name'],
                'division_id' => function () {
                    return Division::inRandomOrder()->first()->id;
                },
                'service_id' => function () {
                    return Service::inRandomOrder()->first()->id;
                },
            ]);
        }

        //Generate device types based on the list below
        $device_types =  [
            ['device_type_name' => 'Laptop', 'device_type_description' => 'Portable computer'],
            ['device_type_name' => 'Desktop', 'device_type_description' => 'Stationary computer'],
            ['device_type_name' => 'Charger', 'device_type_description' => 'Power adapter'],
            ['device_type_name' => 'Monitor', 'device_type_description' => 'Display screen'],
        ];

        foreach ($device_types as $device_type) {
            DeviceType::factory()->count(1)->create([
                'device_type_name' => $device_type['device_type_name'],
                'device_type_description' => $device_type['device_type_description'],
            ]);
        }

        //Generate arrangements based on the list below
        $arrangements =  [
            ['arrangement_name' => 'For Regular', 'arrangement_description' => 'Plantilla or regular employees'],
            ['arrangement_name' => 'For COS', 'arrangement_description' => 'Contract of service employees'],
            ['arrangement_name' => 'For Intern', 'arrangement_description' => 'Students'],
        ];

        foreach ($arrangements as $arrangement) {
            Arrangement::factory()->count(1)->create([
                'arrangement_name' => $arrangement['arrangement_name'],
                'arrangement_description' => $arrangement['arrangement_description'],
            ]);
        }

        //Generate statuses based on the list below
        $statuses =  [
            ['status_name' => 'For Deployment', 'status_description' => 'For Deployment'],
            ['status_name' => 'Deployed', 'status_description' => 'Deployed'],
            ['status_name' => 'For Repair/Checking', 'status_description' => 'For Repair/Checking'],
            ['status_name' => 'For Disposal', 'status_description' => 'For Disposal'],
        ];

        foreach ($statuses as $status) {
            Status::factory()->count(1)->create([
                'status_name' => $status['status_name'],
                'status_description' => $status['status_description'],
            ]);
        }

        //Generate 5 brands
        Brand::factory()->count(5)->create();

        //Generate 5 suppliers
        Supplier::factory()->count(5)->create();

        // Generate 20 devices, each associated with a random existing data
        Device::factory()
            ->count(20)
            ->create([
                'end_user_id' => function () {
                    return EndUser::inRandomOrder()->first()->id;
                },
                'arrangement_id' => function () {
                    return Arrangement::inRandomOrder()->first()->id;
                },
                'brand_id' => function () {
                    return Brand::inRandomOrder()->first()->id;
                },
                'device_type_id' => function () {
                    return DeviceType::inRandomOrder()->first()->id;
                },
                'status_id' => function () {
                    return Status::inRandomOrder()->first()->id;
                },
                'supplier_id' => function () {
                    return Supplier::inRandomOrder()->first()->id;
                },
            ]);
    }
}
