<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


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
        return view('home');
    }

    public function adminHome() {
        return view('adminHome');
    }

    public function viewProfile(User $user){

        return view(view:'perfil', data:[
            'user' => $user,
        ]);
    }

}
