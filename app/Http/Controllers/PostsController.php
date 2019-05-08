<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogPost;
use App\Post;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * returns all the available posts
     *
     * @return View
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

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
    
    /**
     * returns view form to add an article
     *
     * @return void
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * stores new post
     *
     * @return mixed
     */
    public function store(StoreBlogPost $request)
    {
        $validatedPost = $request->validated();
        Post::create($validatedPost);
        return \redirect('posts');
    }

    /**
     * returns view for editing a specific post
     *
     * @param [type] $id
     * @return void
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return \view('posts.edit', compact('post'));
    }

    /**
     * updates existing post
     *
     * @return mixed
     */
    public function update(StoreBlogPost $request, $id)
    {
        $validatedPost = $request->validated();
        $post = Post::find($id);
        $post->update($validatedPost);
        return \redirect("post/$id");
    }
}
