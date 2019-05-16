<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Post;
use App\User;

class UserHomePageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @group auth-home-page
     * @test
     *
     * @return void
     */
    public function authUsersCanOnlySeeTheirPosts()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user); // same as $this->be($user);
        $user1 = factory(User::class)->create(["email" => "user1@email.com"]);
        $post = factory(Post::class)->create(['user_id' => $user->id]);
        $post1 = factory(Post::class)->create(['user_id' => $user1->id]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertDontSee($post1->title);
        $response->assertSee($post->title);
    }
}
