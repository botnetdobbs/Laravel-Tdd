<?php

namespace Tests\Browser;

use App\Post;
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
        $post = \factory(Post::class)->create();
        $post1 = \factory(Post::class)->create();

        $this->browse(function (Browser $browser) use($post, $post1) {
            $browser->visit('/posts')
                    ->assertSee($post->title)
                    ->clickLink('Read More')
                    ->assertPathIs("/posts/{$post->id}")
                    ->assertSee($post->title);
        });
    }
}
