<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::first();

        User::updateOrCreate([
            'name'=> 'Sedra',
            'email'=> 'tianaranaiavoarisoa@gmail.com',
            'phone'=>'8866633656',
            'password'=>Hash::make('12345678'),
            'role_id'=>$role->id,
        ]);
    }
}
