<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserCanRegisterTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @group non-auth-register-page
     * @test
     *
     * @return void
     */
    public function nonAuthUserCanAccessRegisterPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertSee("Register");
        });
    }

    /**
     * @group auth-register-page
     * @test
     *
     * @return void
     */
    public function authUserCannotViewRegisterPage()
    {
        $user = \factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/register')
                    ->assertPathIs('/home') // Redirected to dashboard page...,
                    ->assertSee("Dashboard");
        });
    }

    /**
     * @group user-register
     * @test
     * includes a single edge case (wrong password length)
     *
     * @return void
     */
    public function userCanRegister()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', 'Langley')
                    ->type('email', 'langley@hq.com')
                    ->type('password', 'xbt3yb')
                    ->type('password_confirmation', 'xbt3yb')
                    ->press('Register')
                    ->assertSee("The password must be at least 8 characters.")
                    ->type('password', 'xbt3yb180')
                    ->type('password_confirmation', 'xbt3yb180')
                    ->press('Register')
                    ->assertPathIs('/home')
                    ->assertSee("Dashboard");
        });
    }
}
