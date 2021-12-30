<?php

namespace App\Http\Controllers;

use App\Models\CommentLike;
use App\Models\PostComment;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $comment = new PostComment();
        $comment->post_id = $request['post_id'];
        $comment->user_id = $request->user()->id;
        $comment->content = $request['content'];
        $comment->save();
        return back()->with('Comentário enviado!');
        
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
     * @param  \App\Models\PostComment  $postComment
     * @return \Illuminate\Http\Response
     */
    public function show(PostComment $postComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostComment  $postComment
     * @return \Illuminate\Http\Response
     */
    public function edit(PostComment $postComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostComment  $postComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostComment $postComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostComment  $postComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $comment = PostComment::find($request['comment_id']);
        if ($comment->user == $request->user()) {
            $comment->delete();
        }
        return back();
    }

    public function like(Request $request)
    {
        $user = $request->user();

        $comment_id = $request['id'];

        $comment = PostComment::find($comment_id);
        
        if ($comment) {
            $like_dislike = $request['like_dislike'];
            $comment_like = CommentLike::all()->where('user_id', '=', $user->id)->where('post_comment_id', '=', $comment_id)->first();
            if ($comment_like)
            {
                if ($comment_like->like_dislike == $like_dislike) {
                    $comment_like->delete();
                }
                else
                {
                    $comment_like->like_dislike = $like_dislike;
                    $comment_like->save();
                }
            }
            else
            {
                $comment_like = new CommentLike();
                $comment_like->user_id = $user->id;
                $comment_like->post_comment_id = $comment_id;
                $comment_like->like_dislike = $like_dislike;
                $comment_like->save();
            }
        }
        return back()->withInput();
    }
}
