<?php

namespace Tests\Browser;

use App\User; 
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DuskSimpleTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     *
     * @return void
     */
    public function aUserCanLogIn()
    {
        $user = \factory(User::class)->create();

        $this->browse(function(Browser $browser) use($user) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'password')
                    ->press('Login')
                    ->assertPathIs('/home');
        });
    }

    /**
     * @dusk
     *
     * @return void
     */
    public function aUserCanViewPosts()
    {
        $post = \factory(App\Post::class)->create();

        $this->browse(function(Browser $browser) {
            $browser->visit('/posts')
                    ->assertSee($post->title)
                    ->clickLink($post1->title)
                    ->assertPathIs("posts/{$post1->id}")
                    ->assertSee($post1->title);
        });
    }
}
