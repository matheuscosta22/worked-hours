<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

    public function test_login()
    {
        $user = User::factory()->create();
        $response = $this->postJson('api/login', [
            'email' => $user->email,
            'password' =>  "12345678",
        ]);
        $response->assertStatus(200);
    }

    public function test_logout()
    {
        $response = $this->postJson("api/logout", [], ["Authorization" => "Bearer " . $this->auth()]);
        $response->assertStatus(200);
    }

    public function test_me()
    {
        $response = $this->postJson("api/me", [], ["Authorization" => "Bearer " . $this->auth()]);
        $response->assertStatus(200);
    }


 
    public function auth()
    {
        $user = User::factory()->create();
        $response = $this->postJson('api/login', [
            'email' => $user->email,
            'password' =>  "12345678",
        ]);
        $token = json_decode($response->baseResponse->content())->model;
        return $token;
    }
}
