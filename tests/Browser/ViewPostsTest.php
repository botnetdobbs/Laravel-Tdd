<?php

namespace Tests\Browser;

use App\Post;
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
        $post = \factory(Post::class)->create();
        $post1 = \factory(Post::class)->create();

        $this->browse(function (Browser $browser) use($post, $post1) {
            $browser->visit('/posts')
                    ->assertSee($post->title)
                    ->assertSee($post1->title);
        });
    }
}
