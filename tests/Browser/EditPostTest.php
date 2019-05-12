<?php

namespace Tests\Browser;

use App\User;
use App\Post;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EditPostTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     *
     * @return void
     */
    public function userCanSeeEditPostPage()
    {
        $user = \factory(User::class)->create();
        $post = \factory(Post::class)->create(["user_id" => $user->id]);

        $this->browse(function(Browser $browser) use($user, $post) {
            $browser->loginAS($user)
                    ->visit("/posts")
                    ->clickLink("Edit")
                    ->assertPathIs("/posts/{$post->id}/edit");
        });
    }

    /**
     * @test
     *
     * @return void
     */
    public function userCanEditPost()
    {
        $user = \factory(User::class)->create();
        $post = \factory(Post::class)->create(["user_id" => $user->id]);

        $this->browse(function(Browser $browser) use($user, $post) {
            $browser->loginAS($user)
                    ->visit("/posts")
                    ->clickLink("Edit")
                    ->assertPathIs("/posts/{$post->id}/edit")
                    ->type('title', 'Some New Words')
                    ->press("Save Post")
                    ->assertPathIs("/posts/{$post->id}")
                    ->assertSee("Some New Words");
        });
    }
}
