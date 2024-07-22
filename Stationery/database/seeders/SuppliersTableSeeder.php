<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $suppliers = [
            [
                'name' => 'Supplier One',
                'manager' => 'John Doe',
                'email' => 'john.doe@example.com',
                'phone' => '123-456-7890',
                'address' => '123 Elm Street, Springfield',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Supplier Two',
                'manager' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'phone' => '987-654-3210',
                'address' => '456 Oak Avenue, Springfield',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Supplier Three',
                'manager' => 'Michael Johnson',
                'email' => 'michael.johnson@example.com',
                'phone' => '555-555-5555',
                'address' => '789 Pine Road, Springfield',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($suppliers as $supplier) {
            DB::table('suppliers')->insert([
                'id' => (string) Str::uuid(),
                'name' => $supplier['name'],
                'manager' => $supplier['manager'],
                'email' => $supplier['email'],
                'phone' => $supplier['phone'],
                'address' => $supplier['address'],
                'created_at' => $supplier['created_at'],
                'updated_at' => $supplier['updated_at'],
            ]);
        }
    }
}