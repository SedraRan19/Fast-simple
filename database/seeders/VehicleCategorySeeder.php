<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehicle_category;

class VehicleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    Vehicle_category::updateOrCreate(
        ['name' => 'SUV'],
        [
            'price_per_hour' => 10.99,
            'price_per_mile' => 0.75,
            'base_price' => 25.00,
            'miles_inclided' => 100,
            'user_id'=>1,
        ]
    );

    Vehicle_category::updateOrCreate(
        ['name' => 'SEDAN'],
        [
            'price_per_hour' => 12.99,
            'price_per_mile' => 0.85,
            'base_price' => 30.00,
            'miles_inclided' => 120,
            'user_id'=>1,
        ]
    );

    Vehicle_category::updateOrCreate(
        ['name' => 'VAN'],
        [
            'price_per_hour' => 10.99,
            'price_per_mile' => 0.75,
            'base_price' => 35.00,
            'miles_inclided' => 150,
            'user_id'=>1,
        ]
    );
}

}

