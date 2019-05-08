<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ViewPostsTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     *
     * @return void
     */
    public function aUserCanViewPosts()
    {
        $post = \factory(App\Post::class)->create();
        $post1 = \factory(App\Post::class)->create();

        $this->browse(function(Browser $browser) {
            $browser->visit('/posts')
                    ->assertSee($post->title)
                    ->assertSee($post1->title);
        });
    }
}
