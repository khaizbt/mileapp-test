<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMustEnterEmailAndPassword()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJson([
                "status" => false,
                "message" => [
                    'email' => ["The email field is required."],
                    'password' => ["The password field is required."],
                ],
                "result" => null
            ]);
    }

    public function testSuccessfulLogin()
    {
        $loginData = ['email' => 'user@mailtrap.io', 'password' => 'password123'];

        $this->json('POST', 'api/login', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "message",
                "access_token",
                'token_type'
            ]);

        $this->assertAuthenticated();
    }

}
