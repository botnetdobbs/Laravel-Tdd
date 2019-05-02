<?php

namespace Tests\Feature;

use App\Post;
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
        $post1 = \factory(Post::class)->create();
        $post2 = \factory(Post::class)->create();
        $post3 = \factory(Post::class)->create();

        // act
        $response = $this->get('/posts');

        //assert
        $response->assertStatus(200);
        $response->assertSee($post1->title);
        $response->assertSee($post2->title);
        $response->assertSee($post3->title);
    }
}
