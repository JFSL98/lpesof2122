<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index($user_id = NULL)
    {
        if (!$user_id || User::all()->where('id', $user_id)->isEmpty()) {
            return redirect()->back()->with('A página que tentou visitar não existe.');
        }
        
        $user = User::find($user_id);
        $posts = Post::all()->where('user_id', $user_id)->sortByDesc('created_at');
        return view('profile.index', compact('user','posts'));
    }

    public function pic(User $user){

        return view(view:'profile.upload_pic', data:[
            'user' => $user,
        ]);
    }
}
