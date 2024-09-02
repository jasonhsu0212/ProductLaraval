<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
// use App\Helper\Logger;
use App\Models\Product;
use App\Models\User;


class ProductTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $email = 'testProduct@gmail.com';
        $password = '123456';
        $name = 'testProduct';

        $response = $this->post('/register', [
            'name' =>  $name ,
            'email' => $email,
            'password' => $password,
        ]);

        $response = $this->post('/login', [
            'email' => $email,
            'password' => $password,
        ]);
        $data = $response->json();

        $this->assertNotEmpty($data['authorisation']['token']);

        // $token = $data['authorisation']['token'];

        // $this->withHeader(['Authorization' => 'Bearer ' . $token]);
    }
    
    /*
     * A basic test example.
     */

     public function test_product_getlist_successful_response(): void
     {
         $response = $this->get('/api/products?page=1&per_page=10&keyword=');
         $response->assertStatus(200);

         //Logger::info('resp', $response);
         // 檢查回傳json格式
         $response->assertJsonStructure(
             [
                 'success',
                 'data' => [
                     'data' => [
                         '*' => [
                             'name',
                             'description',
                             'price',
                             'stock'
                         ],
                     ]
                 ]
             ]
         );
     }


     public function test_product_create_successful_response(): void
     {
         $response = $this->post('/api/products', [
             'name' => '葡萄',
             'description' => '屏東葡萄',
             'price' => '650',
             'stock' => '5'
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

     public function test_delete_product_successful_response(): void
     {
         $name = '葡萄';
         Product::where('name', $name)->delete();
         $model = Product::where('name', $name)->get();
         $this->assertEmpty($model);
     }
     
     public function test_delete_user_successful_response(): void
     {
        $name = 'testProduct';
         User::where('name', $name)->delete();
     }
    
}
