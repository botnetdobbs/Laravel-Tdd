<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PagesControllerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function guestUserCanAccessLandingPageAsDefault()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Welcome');
    }

    /**
     * @test
     *
     * @return void
     */
    public function authUserCanAccessDashboardAsDefault()
    {
        $this->be(\factory(User::class)->create());

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Dashboard');

    }
}
