<?php

namespace Tests\Unit;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @group formatted-date
     * @test
     *
     * @return void
     */
    public function canGetCreatedAtFormattedDate()
    {
        // Arrangement step - create an article
        $post = \factory(Post::class)->create();

        // Action step - get value by calling in the method
        $formattedDate = $post->createdAt();

        //Assertion step - status code 200 etc
        $this->assertEquals($post->created_at->toFormattedDateString(), $formattedDate);
    }
}
