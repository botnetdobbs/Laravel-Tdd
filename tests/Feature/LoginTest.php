<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function aUserCanViewLoginPage()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Login');
    }

    /**
     * @test
     *
     * @return void
     */
    public function aUserCanLogIn()
    {
        // arrange phase - create user
        $user = \factory(User::class)->create();

        // action phase
        $response = $this->post('/login', ['email' => $user->email, 'password' => 'password']);

        // assertion phase
        $response->assertStatus(302); // returns a redirect
    }
}
