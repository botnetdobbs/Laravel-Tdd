<?php

namespace Tests\Browser;

use App\User;
use App\Post;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateCommentTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     *
     * @return void
     */
    public function authUserCanCreateComment()
    {
        $user = \factory(User::class)->create();
        $post = \factory(Post::class)->create(["user_id" => $user->id]);

        $this->browse(function (Browser $browser) use ($user, $post) {
            $browser->loginAs($user)
                    ->visit("/posts/{$post->id}")
                    ->type("body", "Good vibes")
                    ->press("Comment")
                    ->assertSee("Good vibes");
        });
    }
}
