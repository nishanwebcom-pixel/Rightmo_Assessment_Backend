<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Currency::insert([
            [
                'name' => 'Sri Lankan Rupee',
                'code' => 'LKR',
                'symbol' => 'Rs',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
