<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use App\Models\User;

class PhotoController extends Controller
{
    /**
     * Guarda foto de perfil de utilizador e associa-a ao mesmo
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $name = $request->file('image')->getClientOriginalName();
        $request->file('image')->store('public/images/profile_pic');


        $user = auth()->user();
        $old_profile_pic = $user->profile_pic;
        if ($old_profile_pic != NULL) {
            unlink('storage/images/profile_pic/' . $old_profile_pic->path);
            $old_profile_pic->delete();
        }

        $picture = new Photo;
        $picture->name = $name;
        $picture->path = $request->file('image')->hashName();
        $picture->user_id=auth()->user()->id;
        $picture->save();
        $user = User::find(auth()->user()->id);
        $picture_path=$picture->path;
        $picture=Photo::where('path',$picture_path)->first();
        $user->profile_pic_id=$picture->id;
        $user->save();
        return redirect()->route('profile',$user->id);
    }
}
