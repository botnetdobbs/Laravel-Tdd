<?php

namespace Tests\Unit;

use App\User;
use App\Post;
use App\Comment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @group comment-formatted-date
     * @test
     *
     * @return void
     */
    public function getFormattedCreatedAtDate()
    {
        $user = \factory(User::class)->create();
        $this->be($user);
        $post = \factory(Post::class)->create(['user_id' => $user->id]);
        $comment = \factory(Comment::class)->create();

        $formattedDate = $comment->createdAt();

        $this->assertEquals($comment->created_at->diffForHumans(), $formattedDate);
    }
}
