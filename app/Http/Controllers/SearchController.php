<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SearchController extends Controller
{
    //search for users by name
    public function search(Request $request)
    {
        $user_search = User::where('name', 'LIKE', '%' . $request->input('user_search') . '%')->get();
        //$user_search = User::where('name', 'LIKE', '%' . $request->input('user_search') . '%');
        return view('partials.listsearch', compact('user_search'));
    }
}
