<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permission::updateOrCreate(
        //     ['name' => 'Create Customers'],
        //     ['name' => 'Manage Customers'],
        //     ['name' => 'Create Bookings'],
        //     ['name' => 'Manage Bookings'],
        //     ['name' => 'Create Vehicles'],
        //     ['name' => 'Manage Vehicles'],
        //     ['name' => 'Create Vehicle Categories'],
        //     ['name' => 'Manage Vehicle Categories'],
        //     ['name' => 'Create Drivers'],
        //     ['name' => 'Manage Drivers'],
        //     ['name' => 'Create Roles'],
        //     ['name' => 'Manage Roles'],
        //     ['name' => 'Create Users'],
        //     ['name' => 'Manage Users'],
        // );

        Permission::updateOrCreate(['name' => 'Create Customers'], [
            'name'=> 'Create Customers',
        ]);

        Permission::updateOrCreate(['name' => 'Manage Customers'], [
            'name'=> 'Manage Customers',
        ]);

        Permission::updateOrCreate(['name' => 'Create Bookings'], [
            'name'=> 'Create Bookings',
        ]);

        Permission::updateOrCreate(['name' => 'Manage Bookings'], [
            'name'=> 'Manage Bookings',
        ]);

        Permission::updateOrCreate(['name' => 'Create Vehicles'], [
            'name'=> 'Create Vehicles',
        ]);

        Permission::updateOrCreate(['name' => 'Manage Vehicles'], [
            'name'=> 'Manage Vehicles',
        ]);

        Permission::updateOrCreate(['name' => 'Create Vehicle Categories'], [
            'name'=> 'Create Vehicle Categories',
        ]);

        Permission::updateOrCreate(['name' => 'Manage Vehicle Categories'], [
            'name'=> 'Manage Vehicle Categories',
        ]);


        Permission::updateOrCreate(['name' => 'Create Drivers'], [
            'name'=> 'Create Drivers',
        ]);


        Permission::updateOrCreate(['name' => 'Manage Drivers'], [
            'name'=> 'Manage Drivers',
        ]);


        Permission::updateOrCreate(['name' => 'Create Roles'], [
            'name'=> 'Create Roles',
        ]);


        Permission::updateOrCreate(['name' => 'Manage Roles'], [
            'name'=> 'Manage Roles',
        ]);


        Permission::updateOrCreate(['name' => 'Create Users'], [
            'name'=> 'Create Users',
        ]);


        Permission::updateOrCreate(['name' => 'Manage Users'], [
            'name'=> 'Manage Users',
        ]);

    }
}
