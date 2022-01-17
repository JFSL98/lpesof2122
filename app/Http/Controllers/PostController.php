<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\PostComment;
use App\Models\PostLike;
use App\Notifications\like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\PseudoTypes\True_;

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
    /**
     * Apresenta a view de um post com respetivos comentários
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function single(Request $request)
    {
        $post = Post::find($request['id']);
        if (!$post) {
            return view('post', compact('post'));
        }

        $comments = $post->postComments->sortByDesc('created_at');
        $commentcount = $post->getCommentCount();

        return view('post', compact('post','comments','commentcount'));
    }

    /**
     * Formulário de criação de posts.
     * 
     * @param  \Illuminate\Http\Request  $request recebe conteúdo do post
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $post = new Post();
        $post->content = $request['content'];
        $request->user()->posts()->save($post);
        return back()->withInput();
    }
    
    /*
    public function destroy(Post $post)
    {

        if ($post->user_id == Auth()->user()->id)
        {
            $post->delete();
        }
        return back()->withInput();
    }*/
    
    /**
     * Remove o post e todos os comentários associados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $post_id = $request['id'];
        $post = Post::find($post_id);

        if ($post && $post->user == $request->user())
        {
            $post->delete();
            $comments = PostComment::all()->where('post_id', '=', $post_id);
            foreach($comments as $comment) {
                $comment->delete();
            }
            return back()->with('status', 'Post eliminado!');
        }

        return back()->with('status', 'Post não eliminado!');
    }
    /**
     * Adiciona um like ou dislike a um post
     *
     * @param  \Illuminate\Http\Request  $request com id do post e boolean (like ou dislike)
     * @return \Illuminate\Http\Response
     */
    public function like(Request $request)
    {
        $user = $request->user();

        $post_id = $request['id'];

        $post = Post::find($post_id);
        
        if ($post) {
            $like_dislike = $request['like_dislike'];
            $post_like = PostLike::all()->where('user_id', '=', $user->id)->where('post_id', '=', $post_id)->first();
            if ($post_like)
            {
                if ($post_like->like_dislike == $like_dislike) {
                    $post_like->delete();
                }
                else
                {
                    $post_like->like_dislike = $like_dislike;
                    $post_like->save();
                }

            }
            else
            {
                $post_like = new PostLike();
                $post_like->user_id = $user->id;
                $post_like->post_id = $post_id;
                $post_like->like_dislike = $like_dislike;
                $post_like->save();
            }
            if($post_like->like_dislike == true)
            {
                $likeData = [
                'body'=>'Recebeste um like!',
                'likeText'=>$user->name.' , gostou de um post seu!',
                'url'=>url('/home')
            ];
    
            $usernotified = $post->user;
            $usernotified->notify(new like($likeData));
            }
        }
      
        return back()->withInput();
    }
}