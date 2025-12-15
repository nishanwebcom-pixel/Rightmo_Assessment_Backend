<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('123'),
                'role_id' => config('constants.ROLES.ADMIN_ROLE')
            ],
            [
                'id' => 2,
                'name' => 'Customer',
                'email' => 'customer@mail.com',
                'password' => Hash::make('123'),
                'role_id' => config('constants.ROLES.CUSTOMER_ROLE')
            ],

        ]);
    }
}
