<?php

namespace App\Http\Controllers;

use App\Models\Friends;
use App\Models\User;
use App\Http\Requests\StoreFriendsRequest;
use App\Http\Requests\UpdateFriendsRequest;
use Illuminate\Http\Request;

class FriendsController extends Controller
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
        //check if arent friends
        $user = User::find(auth()->user()->id);
        $friend = User::find($request['friend_id']);
        $friends = Friends::where('user_id', $user->id)->where('friend_id', $friend->id)->first();
        if ($friends == null) {
            $friends = new Friends();
            $friends->user_id = $user->id;
            $friends->friend_id = $friend->id;
            $friends->validate = false;
            $friends->save();
        }
        return back()->with('Amigo adicionado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Friends  $friends
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $friend = User::find($request['friend_id']);
        $friends = Friends::where('user_id', $user->id)->where('friend_id', $friend->id)->first();
        $friends->delete();
        return back()->with('Amigo removido!');
    }
}
