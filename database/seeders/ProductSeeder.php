<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Product::factory()->create([
            'name' => 'Apple',
            'price' => 100,
            'stock' => 10,
        ]);
        \App\Models\Product::factory()->create([
            'name' => 'Banana',
            'price' => 50,
            'stock' => 20,
        ]);
        \App\Models\Product::factory()->create([
            'name' => 'Cherry',
            'price' => 200,
            'stock' => 5,
        ]);
    }
}
