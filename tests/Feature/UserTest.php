<?php

namespace Tests\Feature;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function test_all_user()
    {
        $response = $this->getJson("api/user", ["Authorization" => "Bearer " . $this->auth()]);

        $response->assertStatus(200);
    }

    public function test_find_user()
    {
        $user = User::factory()->create();
        $response = $this->getJson("api/user/" . $user->id, ["Authorization" => "Bearer " . $this->auth()]);

        $response->assertStatus(200);
    }

    public function test_delete_user()
    {
        $user = User::factory()->create();
        $response = $this->deleteJson("api/user/" . $user->id, [],["Authorization" => "Bearer " . $this->auth()]);

        $response->assertStatus(204);
    }

    public function test_create_user()
    {
        $faker = Factory::create();
        $response = $this->postJson("api/user", [
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'email' => rand(10000000, 99999999) . '@gmail.com',
            'hourly_rate' => rand(10, 999),
            'password' => 'asdfasdf',
        ],["Authorization" => "Bearer " . $this->auth()]);
        $response->assertStatus(201);
    }

    public function test_update_user()
    {
        $faker = Factory::create();
        $user = User::factory()->create();
        $response = $this->putJson("api/user/" . $user->id, ['first_name' => $faker->firstName()],["Authorization" => "Bearer " . $this->auth()]);
        $response->assertStatus(200);
    }



    
    
    public function auth()
    {
        $user = User::factory()->create();
        $response = $this->postJson('api/login', [
            'email' => $user->email,
            'password' =>  "asdfasdf",
        ]);
        $token = json_decode($response->baseResponse->content())->model;
        return $token;
    }
}
