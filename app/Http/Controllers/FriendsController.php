<?php

namespace App\Http\Controllers;

use App\Models\Friends;
use App\Models\User;
use App\Notifications\friendRequest;
use Illuminate\Http\Request;

class FriendsController extends Controller
{
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
        if ($user == $friend) {
            return redirect()->back()->with('error', 'Nao pode se adicionar a si mesmo');
        }
        $friends = Friends::where('user_id', $user->id)->where('friend_id', $friend->id)->first();
        $checksend = Friends::where('user_id', $friend->id)->where('friend_id', $user->id)->first();
        //if ($checksend != null) {
        //    $checksend->validate = true;
        //    $checksend->save();
        //}
        if ($friends == null) {
            $friends = new Friends();
            $friends->user_id = $user->id;
            $friends->friend_id = $friend->id;
            if ($checksend != null) {
                $friends->validate = true;
                $checksend->validate = true;
                $checksend->save();
            } else {
                $friends->validate = false;
            }
            $friends->save();
        }

        $user2 = User::find($friend->id);
        $friendRequestData = [
            'body' => 'Recebeste um follow!',
            'friendRequestText' => $user2->name . ' está-te a seguir, segue-o de volta para o adicionar como amigo!',
            'url' => url('/home')
        ];
        $friend->notify(new friendRequest($friendRequestData));
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

        $checkfriend = Friends::where('user_id', $friend->id)->where('friend_id', $user->id)->first();
        if ($checkfriend != null) {
            $checkfriend->validate = false;
            $checkfriend->save();
        }
        $friends->delete();
        return back()->with('Amigo removido!');
    }
}
