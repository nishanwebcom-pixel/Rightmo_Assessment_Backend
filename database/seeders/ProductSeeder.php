<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currency = DB::table('currencies')->select(
            'name',
            'code',
            'symbol'
        )->where('id', 1)
            ->first();
        if (!$currency) {
            throw new \Exception('Currency with ID 1 not found.');
        }
        $currencyJson = json_encode($currency);

        $products = [
            [
                'name' => 'Dyson V8 Cordless Vacuum Cleaner',
                'category' => 'Home Goods',
                'price' => 349.00,
                'rating' => 5,
                'image' => 'dummy_product.jpg',
                'currency_id' => 1,
                'currency' => $currencyJson,
                'created_by' => 1
            ],
            [
                'name' => 'Philips Steam Iron GC1905',
                'category' => 'Home Goods',
                'price' => 39.99,
                'rating' => 4,
                'image' => 'dummy_product.jpg',
                'currency_id' => 1,
                'currency' => $currencyJson,
                'created_by' => 1
            ],
            [
                'name' => 'Milton Thermosteel Water Bottle 1L',
                'category' => 'Home Goods',
                'price' => 19.99,
                'rating' => 3,
                'image' => 'dummy_product.jpg',
                'currency_id' => 1,
                'currency' => $currencyJson,
                'created_by' => 1
            ],

            [
                'name' => 'Nivea Men Fresh Active Deodorant',
                'category' => 'Beauty & Personal Care',
                'price' => 6.99,
                'rating' => 3,
                'image' => 'dummy_product.jpg',
                'currency_id' => 1,
                'currency' => $currencyJson,
                'created_by' => 1
            ],
            [
                'name' => 'L’Oreal Paris Revitalift Face Serum',
                'category' => 'Beauty & Personal Care',
                'price' => 24.99,
                'rating' => 2,
                'image' => 'dummy_product.jpg',
                'currency_id' => 1,
                'currency' => $currencyJson,
                'created_by' => 1
            ],
            [
                'name' => 'The Ordinary Niacinamide 10% + Zinc 1%',
                'category' => 'Beauty & Personal Care',
                'price' => 14.99,
                'rating' => 4,
                'image' => 'dummy_product.jpg',
                'currency_id' => 1,
                'currency' => $currencyJson,
                'created_by' => 1
            ],
            [
                'name' => 'Philips Beard Trimmer BT1232',
                'category' => 'Beauty & Personal Care',
                'price' => 29.99,
                'rating' => 1,
                'image' => 'dummy_product.jpg',
                'currency_id' => 1,
                'currency' => $currencyJson,
                'created_by' => 1
            ],
            [
                'name' => 'Dove Deep Moisture Body Wash',
                'category' => 'Beauty & Personal Care',
                'price' => 8.49,
                'rating' => 2,
                'image' => 'dummy_product.jpg',
                'currency_id' => 1,
                'currency' => $currencyJson,
                'created_by' => 1
            ],
            [
                'name' => 'Oral-B Pro 1000 Electric Toothbrush',
                'category' => 'Beauty & Personal Care',
                'price' => 59.99,
                'rating' => 3,
                'image' => 'dummy_product.jpg',
                'currency_id' => 1,
                'currency' => $currencyJson,
                'created_by' => 1
            ],
            [
                'name' => 'Neutrogena Hydro Boost Water Gel',
                'category' => 'Beauty & Personal Care',
                'price' => 21.99,
                'rating' => 4,
                'image' => 'dummy_product.jpg',
                'currency_id' => 1,
                'currency' => $currencyJson,
                'created_by' => 1
            ],
            [
                'name' => 'Nike Brasilia Training Backpack',
                'category' => 'Sports & Outdoors',
                'price' => 44.99,
                'rating' => 5,
                'image' => 'dummy_product.jpg',
                'currency_id' => 1,
                'currency' => $currencyJson,
                'created_by' => 1
            ],
            [
                'name' => 'Adidas Performance Running Shoes',
                'category' => 'Sports & Outdoors',
                'price' => 89.99,
                'rating' => 3,
                'image' => 'dummy_product.jpg',
                'currency_id' => 1,
                'currency' => $currencyJson,
                'created_by' => 1
            ],
            [
                'name' => 'Yonex Carbonex Badminton Racket',
                'category' => 'Sports & Outdoors',
                'price' => 69.99,
                'rating' => 1,
                'image' => 'dummy_product.jpg',
                'currency_id' => 1,
                'currency' => $currencyJson,
                'created_by' => 1
            ],
            [
                'name' => 'Decathlon Quechua Camping Tent (2 Person)',
                'category' => 'Sports & Outdoors',
                'price' => 129.00,
                'rating' => 2,
                'image' => 'dummy_product.jpg',
                'currency_id' => 1,
                'currency' => $currencyJson,
                'created_by' => 1
            ],
            [
                'name' => 'Wilson Evolution Indoor Basketball',
                'category' => 'Sports & Outdoors',
                'price' => 59.99,
                'rating' => 3,
                'image' => 'dummy_product.jpg',
                'currency_id' => 1,
                'currency' => $currencyJson,
                'created_by' => 1
            ],
            [
                'name' => 'Fitbit Charge 5 Fitness Tracker',
                'category' => 'Sports & Outdoors',
                'price' => 149.99,
                'rating' => 2,
                'image' => 'dummy_product.jpg',
                'currency_id' => 1,
                'currency' => $currencyJson,
                'created_by' => 1
            ],
             [
                'name' => 'Philips Air Fryer HD9200',
                'category' => 'Home Goods',
                'price' => 129.99,
                'rating' => 5,
                'image' => 'product1.webp',
                'currency_id' => 1,
                'currency' => $currencyJson,
                'created_by' => 1
            ],
            [
                'name' => 'IKEA Lack Coffee Table',
                'category' => 'Home Goods',
                'price' => 49.99,
                'rating' => 4,
                'image' => 'product2.avif',
                'currency_id' => 1,
                'currency' => $currencyJson,
                'created_by' => 1
            ],
            [
                'name' => 'Prestige Stainless Steel Pressure Cooker',
                'category' => 'Home Goods',
                'price' => 89.50,
                'rating' => 3,
                'image' => 'product3.webp',
                'currency_id' => 1,
                'currency' => $currencyJson,
                'created_by' => 1
            ],
            [
                'name' => 'Samsung 28L Microwave Oven',
                'category' => 'Home Goods',
                'price' => 179.00,
                'rating' => 1,
                'image' => 'product4.jpg',
                'currency_id' => 1,
                'currency' => $currencyJson,
                'created_by' => 1
            ],
        ];
        Product::insert($products);
    }
}
