<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Helper\Logger;
use Tests\TestCase;
use App\Models\User;
// use App\Helper\Logger;
use App\Models\Employee;


class EmployeeTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $email = 'testEmployee@gmail.com';
        $password = '123456';
        $name = 'testEmployee';

        $response = $this->post('/register', [
            'name' =>  $name,
            'email' => $email,
            'password' => $password,
        ]);

        $response = $this->post('/login', [
            'email' => $email,
            'password' => $password,
        ]);
        $data = $response->json();

        $this->assertNotEmpty($data['authorisation']['token']);

        $token = $data['authorisation']['token'];
        // Logger::info('token', $token);

        // $this->withHeader(['Authorization' => 'Bearer ' . $token]);
    }
    /**
     * A basic test example.
     */

    protected $email = 'test@gmail.com';
    public function test_employee_getlist_successful_response(): void
    {
        $response = $this->get('/api/employees?page=1&per_page=10&keyword=&dep_code=');
        $response->assertStatus(200);

        // 檢查回傳json格式
        $response->assertJsonStructure(
            [
                'success',
                'data' => [
                    'data' => [
                        '*' => [
                            'id',
                            'name',
                            'email',
                            'dep_code',
                            'dep_name'
                        ],
                    ]
                ]
            ]
        );
    }


     public function test_employee_create_successful_response(): void
     {
         $this->email =  'testaaaa@test.com';
         $response = $this->post('/api/employees', [
             'name' => 'test',
             'email' => $this->email,
             'dep_code' => 'HR',
             'password' => bcrypt('1qaz@WSX')
         ]);
         $response->assertStatus(200);

         // 檢查回傳json格式
         $response->assertJsonStructure(
             [
                 'success',
                 'data'
             ]
         );
     }

    public function test_employee_update_successful_response(): void
    {
        $this->email = 'testaaaa@test.com';
        //查詢員工
        $model = Employee::where('email', $this->email)->first();

        $id = $model->id;
        //
        $response = $this->put('/api/employees/' . $id, [
            'name' => '0000',
            'email' => 'testaaaa@test.com',
            'dep_code' => 'IT',
            'password' => bcrypt('1qaz@WSX')
        ]);


        $response->assertStatus(200);

        // 檢查回傳json格式
        $response->assertJsonStructure(
            [
                'success',
                'data'
            ]
        );
    }

    public function test_delete_employee_successful_response(): void
    {
         $this->email = 'testaaaa@test.com';
         Employee::where('email', $this->email)->delete();
         $model = Employee::where('email', $this->email)->get();
         $this->assertEmpty($model);
    }

    public function test_delete_user_successful_response(): void
    {
        $name = 'testEmployee';
        User::where('name', $name)->delete();
    }
}
