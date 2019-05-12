<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\StoreComment;

class CommentsController extends Controller
{
    /**
     * store comment in db
     *
     * @param StoreComment $request
     * @param int $id
     * @return void
     */
    public function store(StoreComment $request, $id)
    {
        $comment = $request->validated();

        Comment::create(array_merge($comment, ['post_id' => $id, 'author' => auth()->user()->name]));

        return \redirect()->back();
    }
}
