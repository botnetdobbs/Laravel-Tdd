<?php

namespace Tests\Browser;

use App\User;
use App\Post;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdatePostTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     *
     * @return void
     */
    public function userCanViewEditPostPage()
    {
        $user = \factory(User::class)->create();
        $post = \factory(Post::class)->create();

        $this->browse(function (Browser $browser) use ($user, $post) {
            $browser->loginAs($user)
                    ->visit("/posts/{$post->id}/edit")
                    ->assertSee('Edit');
        });
    }

    /**
     * @test
     *
     * @return void
     */
    public function userCanUpdatePost()
    {
        $user = \factory(User::class)->create();
        $post = \factory(Post::class)->create();

        $this->browse(function (Browser $browser) use ($user, $post) {
            $browser->loginAs($user)
                    ->visit("/posts/{$post->id}/edit")
                    ->type('title', 'New Title')
                    ->type('body', 'New Body')
                    ->press('Save Post')
                    ->assertPathIs("/posts/{$post->id}");
        });
    }
}
