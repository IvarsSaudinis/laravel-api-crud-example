<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_registration()
    {
        $data = [
            'email' => 'test@test.com',
            'name' => 'Test User',
            'password' => 'secret_password',
            'password_confirmation' => 'secret_password',
        ];

        $response = $this->json('POST', route('api.createUser'), $data);
        $response->assertStatus(200);
        $this->assertArrayHasKey('token', $response->json());

        User::where('email','test@test.com')->delete();
    }

    public function test_user_login()
    {
        User::create([
            'name' => 'test',
            'email'=>'test@test.com',
            'password' => bcrypt('secret_password')
        ]);

        $response = $this->json('POST', route('api.loginUser'),[
            'email' => 'test@test.com',
            'password' => 'secret_password',
        ]);

        $response->assertStatus(200);
        $this->assertArrayHasKey('token', $response->json());

        User::where('email','test@test.com')->delete();
    }
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
