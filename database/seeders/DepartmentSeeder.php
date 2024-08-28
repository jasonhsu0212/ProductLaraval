<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Department::factory()->create([
        'name' => '資訊部',
        'code' => 'IT',
       ]);
       Department::factory()->create([
        'name' => '研發部',
        'code' => 'RD',
       ]);
       Department::factory()->create([
        'name' => '公關部',
        'code' => 'PR',
       ]);
       Department::factory()->create([
        'name' => '人資部',
        'code' => 'HR',
       ]);
    }
}
