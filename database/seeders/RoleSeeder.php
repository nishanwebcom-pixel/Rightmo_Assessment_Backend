<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use function Illuminate\Support\now;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Role::insert([
            [
                'id' => config('constants.ROLES.ADMIN_ROLE'),
                'name' => 'Admin',
                'description' => 'Admin Role',
                'created_at' => now()
            ],
            [
                'id' => config('constants.ROLES.CUSTOMER_ROLE'),
                'name' => 'Customer',
                'description' => 'Customer Role',
                'created_at' => now()
            ],

        ]);
    }
}
