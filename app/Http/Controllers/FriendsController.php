<?php

namespace App\Http\Controllers;

use App\Models\Friends;
use App\Models\User;

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
        $checksend = Friends::where('user_id', $friend->id)->where('friend_id', $user->id)->first();
        if($checksend != null){
            $checksend->validate = true;
            $checksend->save();
        }
        if ($friends == null) {
            $friends = new Friends();
            $friends->user_id = $user->id;
            $friends->friend_id = $friend->id;
            if($checksend != null){
                $friends->validate = true;
            }else{
                $friends->validate = false;
            }
            $friends->save();
        }
        return back()->with('Amigo adicionado!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Friends  $friends
     * @return \Illuminate\Http\Response
     */
    public function show(Friends $friends)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Friends  $friends
     * @return \Illuminate\Http\Response
     */
    public function edit(Friends $friends)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Friends  $friends
     * @return \Illuminate\Http\Response
     */
    public function update(Friends $friends)
    {
        //
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

        $checkfriend = Friends::where('user_id', $friend->id)->where('friend_id', $user->id)->first();
        if($checkfriend != null){
            $checkfriend->validate = false;
            $checkfriend->save();
        }
        $friends->delete();
        return back()->with('Amigo removido!');
    }
}
