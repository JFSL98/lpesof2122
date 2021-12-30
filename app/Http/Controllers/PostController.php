<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\PostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all(); //fetch all blog posts from DB
        return view('partials.post', [
            'posts' => $posts,
        ]);
    }

    public function single(Request $request)
    {
        $post = Post::find($request['id']);
        if (!$post) {
            return view('post', compact('post'));
        }

        $comments = PostComment::all()->where('post_id', '=', $post->id)->sortByDesc('created_at');
        $commentcount = $post->getCommentCount();

        return view('post', compact('post','comments','commentcount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $post = new Post();
        $post->content = $request['content'];
        $request->user()->posts()->save($post);
        return back()->withInput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    /*
    public function destroy(Post $post)
    {

        if ($post->user_id == Auth()->user()->id)
        {
            $post->delete();
        }
        return back()->withInput();
    }*/

    public function destroy(Request $request)
    {
        $post_id = $request['id'];
        $post = Post::find($post_id);

        if ($post->user == $request->user()) {
            $post->delete();
        }

        $comments = PostComment::all()->where('post_id', '=', $post_id);
        foreach($comments as $comment) {
            $comment->delete();
        }
        
        return back()->with('status', 'Post eliminado!');
    }
}