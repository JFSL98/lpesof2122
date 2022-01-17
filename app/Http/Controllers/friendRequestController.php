<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\friendRequest;
use Illuminate\Http\Request;

class friendRequestController extends Controller
{
    public function sendFriendReqNotification(){

        $user =User::first();

        $friendRequestData = [
                'body'=>'Recebeste um friend request!',
                'friendRequestText'=>'Entra e aceita o pedido para teres mais um amigo.',
                'url'=>url('/home')
        ];

        $user->notify(new friendRequest($friendRequestData));
    }
}
