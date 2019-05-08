<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreatePostTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     *
     * @return void
     */
    public function aUserCanCreatePost()
    {
        $user = \factory(App\User::class)->create();

        $this->browse(function(Browser $browser) {
            $browser->loginAs($user)
                ->visit('/posts/create')
                ->type('title', 'New Post')
                ->type('body', 'New description')
                ->press('Save Post')
                ->assertPathIs('/posts')
                ->assertSee('New Post');
        }); 
    }

    /**
     * @test
     *
     * @return void
     */
    public function onlyAuthUserCanCreatePost()
    {
        $this->browse(function(Browser $browser) {
            $browser->visit('/posts/create')
                ->assertPathIs('/login');
        }); 
    }
}
