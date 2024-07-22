<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProductsTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $categories = DB::table('categories')->pluck('id');
        $states = DB::table('states')->pluck('id');
        $suppliers = DB::table('suppliers')->pluck('id');

        $products = [
            [
                'image_url' => 'https://example.com/image1.jpg',
                'name' => 'Product One',
                'description' => 'Description for Product One',
                'price' => 19.99,
                'stock_quantity' => 100,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'categorie_id' => $categories->random(),
                'state_id' => $states->random(),
                'supplier_id' => $suppliers->random(),
            ],
            [
                'image_url' => 'https://example.com/image2.jpg',
                'name' => 'Product Two',
                'description' => 'Description for Product Two',
                'price' => 29.99,
                'stock_quantity' => 200,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'categorie_id' => $categories->random(),
                'state_id' => $states->random(),
                'supplier_id' => $suppliers->random(),
            ],
            [
                'image_url' => 'https://example.com/image3.jpg',
                'name' => 'Product Three',
                'description' => 'Description for Product Three',
                'price' => 39.99,
                'stock_quantity' => 300,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'categorie_id' => $categories->random(),
                'state_id' => $states->random(),
                'supplier_id' => $suppliers->random(),
            ],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert([
                'id' => (string) Str::uuid(),
                'image_url' => $product['image_url'],
                'name' => $product['name'],
                'description' => $product['description'],
                'price' => $product['price'],
                'stock_quantity' => $product['stock_quantity'],
                'created_at' => $product['created_at'],
                'updated_at' => $product['updated_at'],
                'categorie_id' => $product['categorie_id'],
                'state_id' => $product['state_id'],
                'supplier_id' => $product['supplier_id'],
            ]);
        }
    }
}
