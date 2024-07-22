<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StatesTableSeeder extends Seeder
{
    public function run()
    {
        $states = [
                ['name' => 'Active'],
                ['name' => 'Inactive']
            ];

        foreach ($states as $state) {
            DB::table('states')->insert([
                'id' => (string) Str::uuid(),
                'name' => $state['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
