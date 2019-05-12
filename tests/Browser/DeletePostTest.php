<?php

namespace Tests\Browser;

use App\User;
use App\Post;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DeletePostTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @group delete-button-view
     * @test
     *
     * @return void
     */
    public function nonAuthACannotSeeDeleteButton()
    {
        $user = \factory(User::class)->create();
        $user1 = \factory(User::class)->create(["email" => "test@email.dusk.com"]);

        \factory(Post::class)->create(['user_id' => $user1->id]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/posts')
                    ->assertDontSee("Delete");
        });
    }

    /**
     * @group auth-delete-post-button-view
     * @test
     *
     * @return void
     */
    public function authUserCanSeeDeleteButton()
    {
        $user = \factory(User::class)->create();
        \factory(Post::class)->create(['user_id' => $user->id]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/posts')
                ->assertSee("Delete");
        });
    }

    /**
     * @group auth-delete-post
     * @test
     *
     * @return void
     */
    public function authUserCanDeletePost()
    {
        $user = \factory(User::class)->create();
        $post = \factory(Post::class)->create(["user_id" => $user->id]);

        $this->browse(function (Browser $browser) use ($user, $post) {
            $browser->loginAS($user)
                    ->visit("/posts")
                    ->assertSee($post->title)
                    ->press("Delete")
                    ->assertDontSee($post->title);
        });
    }
}
