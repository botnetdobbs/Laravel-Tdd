<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class DashboardHomeTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @group browser-access-dashboard/home
     * @test
     *
     * @return void
     */
    public function authUserCanAccessDashboardFromUserDropdownMenu()
    {
        $user = factory(User::class)->create();

        $this->browse(function(Browser $browser) use($user) {
            $browser->loginAs($user)
                    ->visit('/posts')
                    ->clickLink($user->name)
                    ->assertSee('Dashboard')
                    ->clickLink('Dashboard')
                    ->assertPathIs('/home');
        });
    }
}
