<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehicle::create(
            [
                'make' => 'Toyota',
                'model' => 'Camry',
                'license_plate' => 'ABC123',
                'vehicle_category_id' => 1,
                'user_id'=>1,
            ],
            [
                'make' => 'Honda',
                'model' => 'Accord',
                'license_plate' => 'XYZ789',
                'vehicle_category_id' => 2,
                'user_id'=>1,
            ],
        );
    }
}
