<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogPost;
use App\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        $posts = Post::with("author")->paginate(8);
        return view('posts.index', compact('posts'));
    }

    /**
     * returns a single post item
     *
     * @param int $id
     * @return View
     */
    public function show($id)
    {
        try {
            $post = Post::findOrFail($id);
        } catch (ModelNotFoundException $e) {
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
        Post::create(array_merge($validatedPost, ["user_id" => auth()->user()->id]));
        return \redirect('posts');
    }

    /**
     * returns view for editing a specific post
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        try {
            $post = Post::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
        return (auth()->user()->id !== (int) $post->user_id) ? $this->redirectNonPostOwner() : \view('posts.edit', compact('post'));
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

    /**
     * deletes a specific post
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(404);
        }

        return (auth()->user()->id !== (int) $post->user_id) ? $this->redirectNonPostOwner() :
        (function () use ($post) {
            $post->delete();
            return \redirect()->back();
        })();
    }

    /**
     * redirect users if they don't own a resource
     *
     * @return void
     */
    protected function redirectNonPostOwner()
    {
        return \redirect()->back()->with('failure', 'Unauthorized action');
    }
}
