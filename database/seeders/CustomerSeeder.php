<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{Customer,User};

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        Customer::create(
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'phone' => 123456789,
                'home_address' => '123 Main St',
                'office_address' => '456 Business St',
                'permanent_note' => 'Permanent Note',
                'private_general_notes' => 'Private General Notes',
                'driver_notes' => 'Driver Notes',
                'user_id' => 1, 
            ] 
        );
    }
}
