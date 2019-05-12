<?php

namespace Tests\Feature;

use App\User;
use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @group auth-comment-form
     * @test
     *
     * @return void
     */
    public function authUserCanViewCommentForm()
    {
        $user = \factory(User::class)->create();
        $this->be($user);
        $post = \factory(Post::class)->create(['user_id' => $user->id]);

        $response = $this->get("/posts/{$post->id}");

        $response->assertSee('Leave a reply');
    }

    /**
     * @group non-auth-comment-form
     * @test
     *
     * @return void
     */
    public function nonAuthUserCanViewCommentForm()
    {
        $user = \factory(User::class)->create();
        $post = \factory(Post::class)->create(['user_id' => $user->id]);

        $response = $this->get("/posts/{$post->id}");

        $response->assertDontSee('Leave a reply');
    }

    /**
     * @group auth-post-comment
     * @test
     *
     * @return void
     */
    public function authUserCanPostAComment()
    {
        $user = \factory(User::class)->create();
        $this->be($user); // $this->actingAs($user); //same
        $post = \factory(Post::class)->create(['user_id' => $user->id]);
        $comment = ['body' => "New Comment"];

        $response = $this->post("/posts/{$post->id}/comments", $comment);

        $response->assertStatus(302);
        $this->assertDatabaseHas('comments', $comment);
    }
}
