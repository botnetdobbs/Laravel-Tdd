<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ViewPostTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     *
     * @return void
     */
    public function aUserCanViewPost()
    {
        $post = \factory(App\Post::class)->create();
        $pos1 = \factory(App\Post::class)->create();

        $this->browse(function(Browser $browser) {
            $browser->visit('/posts')
                    ->assertSee($post->title)
                    ->clickLink($post1->title)
                    ->assertPathIs("posts/{$post1->id}")
                    ->assertSee($post1->title);
        });
    }
}
