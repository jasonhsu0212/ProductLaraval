<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Employee::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
            'password' =>  bcrypt('1qaz@WSX'),  
            'dep_code' => 'IT',
            
        ]);
        \App\Models\Employee::factory()->create([
            'name' => 'Mary Lin',
            'email' => 'mary@gmail.com',
            'password' =>  bcrypt('123456@WSX'),
            'dep_code' => 'PR',
            
        ]);
    }
}
