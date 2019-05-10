<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewAllBlogPostsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @group view-all-posts
     * @test
     *
     * @return void
     */
    public function userCanViewAllBlogPosts()
    {
        // arrange
        $user = \factory(User::class)->create();
        $this->be($user);
        $post1 = \factory(Post::class)->create(['user_id' => $user->id]);
        $post2 = \factory(Post::class)->create(['user_id' => $user->id]);
        $post3 = \factory(Post::class)->create(['user_id' => $user->id]);

        // act
        $response = $this->get('/posts');

        //assert
        $response->assertStatus(200);
        $response->assertSee($post1->title);
        $response->assertSee($post2->title);
        $response->assertSee($post3->title);
    }
}
