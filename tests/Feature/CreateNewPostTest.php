<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateNewPostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @group view-create-page
     * @test
     * 
     * @return void
     */
    public function canViewPageForCreatingPost()
    {   // generate the user and set as currently authenticated
        $this->be(\factory(User::class)->create());

        $response = $this->get('/posts/create');
        $response->assertStatus(200);
        $response->assertSee('Create Post');
    }

    /**
     * @group new-post
     * @test
     *
     * @return void
     */
    public function canCreateNewPost()
    {
        // arrange - create the user array and generate the user and set as currently authenticated
        $post = [
            'title' => 'new Post',
            'body' => 'new post created just now',
        ];
        $this->be(\factory(User::class)->create());

        //action
        $response = $this->post('/posts', $post);

        //assert
        $this->assertDatabaseHas('posts', $post);
        $newPost = Post::find(1);
        $this->assertEquals($post['title'], $newPost->title);
    }

    /**
     * @group required-title
     * @test
     *
     * @return void
     */
    public function titleIsRequiredToCreateANewPost()
    {
        // arrange
        $post = [
            'title' => null,
            'body' => 'new post created just now',
        ];

        $this->be(\factory(User::class)->create());


        // action
        $response = $this->post('/posts', $post);

        // assert
        $response->assertSessionHasErrors('title');
    }
}
