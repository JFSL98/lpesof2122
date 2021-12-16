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
        // Substituir por um erro
        /**
         * Se o @param user_id for nulo ou não existir,
         * redireciona para o perfil do user autenticado.
         */
        if (!$user_id || User::all()->where('id', $user_id)->isEmpty()) {
            $user_id = Auth::user()->id;
        }
        
        $user = User::find($user_id);
        $posts = Post::all()->where('user_id', $user_id)->sortByDesc('created_at');
        return view('perfil', compact('user','posts'));
    }
}
