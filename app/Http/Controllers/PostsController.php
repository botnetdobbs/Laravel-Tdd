<?php

namespace App\Http\Controllers;

use App\Post;

class PostsController extends Controller
{
    /**
     * returns a single post item
     *
     * @param [int] $id
     * @return View
     */
    public function show($id)
    {
        try {
            $post = Post::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404);
        }
        return \view('posts.show', \compact('post'));
    }
}
