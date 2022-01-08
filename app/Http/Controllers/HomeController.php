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
     * Apresenta a home page com todos os posts por ordem decrescente de data
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::all()->sortByDesc('created_at');
        return view('home', compact('posts'));
    }

    /**
     * Apresenta a home page do administrador
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome() {
        return view('adminHome');
    }
}
