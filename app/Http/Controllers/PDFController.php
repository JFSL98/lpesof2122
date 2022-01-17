<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\Friends;
use PDF;

class PDFController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    
    //Export user and friend information to pdf
    public function export() {
        $user = User::find(auth()->user()->id);
        $friends_id = Friends::all()->where('user_id', $user->id)->where('validate',true);
        $followers_id = Friends::all()->where('user_id', $user->id)->where('validate',false);
        $friends = array();
        foreach($friends_id as $friend_id){
        array_push($friends,User::all()->where('id','=',$friend_id->friend_id)->first());
        }
        $followers = array();
        foreach($followers_id as $follower_id){
            array_push($followers,User::all()->where('id','=',$follower_id->friend_id)->first());
        }
        //return view('partials.listfriends', compact('friends'));
        $pdf = PDF::loadView('partials.listfriends', compact('friends','followers'));
        return $pdf->download('users.pdf');
    }

    //Export posts from user information to pdf
    public function exportPost() {
        $user = User::find(auth()->user()->id);
        $posts = Post::all()->where('user_id','=', $user->id);
        //return view('partials.exportposts', compact('posts'));
        $pdf = PDF::loadView('partials.exportposts', compact('posts'));
        return $pdf->download('posts.pdf');
    }
}
