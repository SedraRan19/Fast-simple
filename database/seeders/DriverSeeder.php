<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Driver;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Driver::create(
            [
                'first_name' => 'David',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'phone' => 123456789,
                'payment_method' => 'Credit Card',
                'user_id'=>1,
            ],
            [
                'first_name' => 'Mike',
                'last_name' => 'Doe',
                'email' => 'jane@example.com',
                'phone' => 987654321,
                'payment_method' => 'PayPal',
                'user_id'=>1,
            ],
        );
    }
}
