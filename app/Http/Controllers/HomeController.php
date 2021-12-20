<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::all()->sortByDesc('created_at');
        return view('home', compact('posts'));
    }

    public function adminHome() {
        return view('adminHome');
    }

    public function viewProfile(User $user){

        return view(view:'profile.index', data:[
            'user' => $user,
        ]);
    }

}
