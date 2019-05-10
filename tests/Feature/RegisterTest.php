<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function aUserCanViewRegisterPage()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertSee('Register');
    }

    /**
     * @test
     *
     * @return void
     */
    public function aUserCanRegister()
    {
        // arrange phase
        $user = [
            'name' => 'some name',
            'email' => 'example@email.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        // action phase
        $response = $this->post('/register', $user);

        //assertion phase
        $this->assertDatabaseHas('users', ['name' => $user['name']]);
        $response->assertStatus(302); // redirection
    }
}
