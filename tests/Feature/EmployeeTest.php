<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Helper\Logger;
use App\Models\Employee;


class EmployeeTest extends TestCase
{
    // public function setUp(): void
    // {
    //     parent::setUp();
    //     $token = User::find(1)->createToken('test')->pkainTextToken;
    //     Logger::info('token', $token);
    //     // $this->withHeader(['Authorization' => 'Bearer ' . $token]);
    // }
    /**
     * A basic test example.
     */

    protected $email = 'test@gmail.com';
    public function test_employee_getlist_successful_response(): void
    {
        $response = $this->get('/api/employees?page=1&per_page=10&keyword=&dep_code=');
        Logger::info('response', $response->content());
        $response->assertStatus(200);

        Logger::info('resp', $response);
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
        Logger::info('response', $response->content());
        $response->assertStatus(200);

        Logger::info('resp', $response);
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
        Logger::info('mmmmmmm', $this->email);
        Logger::info('step', '1');
        //查詢員工
        $model = Employee::where('email', $this->email)->get();
        Logger::info('mmmmmmm', $model);

        $id = $model->id;
        Logger::info('id', $id);
        //
        $response = $this->put('/api/employees/' . $id, [
            'name' => 'test',
            'email' => (new \DateTime())->format('Y-m-d H:i:s') . 'aaaa@test.com',
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
}
