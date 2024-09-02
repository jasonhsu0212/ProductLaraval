<?php

namespace Tests\Feature;

use App\Helper\Logger;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */

      public function test_register_success(): void
      {
          $email = 'test@gmail.com';
          $password = '123456';

          $response = $this->post('/register', [
              'name' => 'test',
              'email' => $email,
              'password' => $password,
          ]);

          $response->assertStatus(200);

          $model = User::where('email', $email)->first();
          $this->assertNotEmpty($model);
      }

     public function test_login_success(): void
     {
         $email = 'test@gmail.com';
         $password = '123456';

         $response = $this->post('/login', [
             'email' => $email,
             'password' => $password,
         ]);
         $data = $response->json();

         $this->assertNotEmpty($data['authorisation']['token']);
     }

     public function test_delete_user_successful_response(): void
     {
          $email = 'test@gmail.com';
          User::where('email', $email)->delete();
          $model = User::where('name', $email)->get();
          $this->assertEmpty($model);
     }
}
