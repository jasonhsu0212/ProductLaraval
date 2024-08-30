<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
            // $dep = Department::factory()->create([
            //     'name' => '資訊部',
            //     'code' => 'IT',
            // ]);
            //  $dep2 = Department::factory()->create([
            //      'name' => '研發部',
            //      'code' => 'RD',
            //  ]);
            // $dep = Department::factory()->create([
            //     'name' => '公關部',
            //     'code' => 'PR',
            // ]);
            // $dep = Department::factory()->create([
            //     'name' => '人資部',
            //     'code' => 'HR',
            // ]);
             $employee = Employee::factory()->create([
                 'name' => 'John Doe',
                 'email' => 'john@gmail.com',
                 'password' =>  bcrypt('1qaz@WSX'),
                 'dep_code' => 'IT',
             ]);
             $employee = Employee::factory()->create([
                'name' => 'John 0',
                'email' => '000000@gmail.com',
                'password' =>  bcrypt('1qaz@WSX'),
                'dep_code' => 'IT',
            ]); $employee = Employee::factory()->create([
                'name' => 'John 1',
                'email' => '111@gmail.com',
                'password' =>  bcrypt('1qaz@WSX'),
                'dep_code' => 'IT',
            ]); $employee = Employee::factory()->create([
                'name' => 'John 2',
                'email' => '222@gmail.com',
                'password' =>  bcrypt('1qaz@WSX'),
                'dep_code' => 'HR',
            ]); $employee = Employee::factory()->create([
                'name' => 'John 3',
                'email' => '333@gmail.com',
                'password' =>  bcrypt('1qaz@WSX'),
                'dep_code' => 'RD',
            ]); $employee = Employee::factory()->create([
                'name' => 'John 4',
                'email' => '444@gmail.com',
                'password' =>  bcrypt('1qaz@WSX'),
                'dep_code' => 'IT',
            ]); $employee = Employee::factory()->create([
                'name' => 'John 5',
                'email' => '555@gmail.com',
                'password' =>  bcrypt('1qaz@WSX'),
                'dep_code' => 'IT',
            ]); $employee = Employee::factory()->create([
                'name' => 'John 6',
                'email' => '666@gmail.com',
                'password' =>  bcrypt('1qaz@WSX'),
                'dep_code' => 'HR',
            ]);  $employee = Employee::factory()->create([
                'name' => 'John 7',
                'email' => '777@gmail.com',
                'password' =>  bcrypt('1qaz@WSX'),
                'dep_code' => 'IT',
            ]); $employee = Employee::factory()->create([
                'name' => 'John 8',
                'email' => '888@gmail.com',
                'password' =>  bcrypt('1qaz@WSX'),
                'dep_code' => 'IT',
            ]); $employee = Employee::factory()->create([
                'name' => 'John 9',
                'email' => '999@gmail.com',
                'password' =>  bcrypt('1qaz@WSX'),
                'dep_code' => 'PR',
            ]); $employee = Employee::factory()->create([
                'name' => 'John 10',
                'email' => '100@gmail.com',
                'password' =>  bcrypt('1qaz@WSX'),
                'dep_code' => 'IT',
            ]); $employee = Employee::factory()->create([
                'name' => 'John 11',
                'email' => '111111@gmail.com',
                'password' =>  bcrypt('1qaz@WSX'),
                'dep_code' => 'IT',
            ]); $employee = Employee::factory()->create([
                'name' => 'John 12',
                'email' => '121212@gmail.com',
                'password' =>  bcrypt('1qaz@WSX'),
                'dep_code' => 'IT',
            ]); 

    }
}
