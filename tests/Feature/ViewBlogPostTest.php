<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewBlogPostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function userCanViewABlogPost()
    {
        // Arrangement step - create an article
        $user = \factory(User::class)->create();
        $this->be($user);
        $post = \factory(Post::class)->create(['user_id' => $user->id]);

        // Action step - visit the route
        $response = $this->get("/post/{$post->id}");

        //Assertion step - status code 200 etc
        $response->assertStatus(200);
        $response->assertSee($post->title);
        $response->assertSee($post->body);
        $response->assertSee($post->createdAt());
    }

    /**
     * @group post-not-found
     * @test
     *
     * @return void
     */

    public function view404PageWhenPostIsNotFound()
    {
        // Arrangement step - no creating an article since intent is 404

        // Action step - visit the route
        $id = 100;
        $response = $this->get("/post/{$id}");

        //Assertion step - status code 400 etc
        $response->assertStatus(404);
        $response->assertSee('The page you are looking for could not be found');
    }
}
