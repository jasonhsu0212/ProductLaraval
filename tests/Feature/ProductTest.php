<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Helper\Logger;
use App\Models\Product;


class ProductTest extends TestCase
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

    public function test_product_getlist_successful_response(): void
    {
        $response = $this->get('/api/product?page=1&per_page=10&keyword=');
        $response->assertStatus(200);

        Logger::info('resp', $response);
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
            'name' => '香蕉',
            'description' => '屏東香蕉',
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

    public function test_product_update_successful_response(): void
    {
        //查詢員工
        $model = Product::where('name', '香蕉')->get();

        $id = $model->id;
        //
        $response = $this->put('/api/products/' . $id, [
            'name' => '香蕉',
            'description' => '台中香蕉',
            'price' => '300',
            'stock' => '1'
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
