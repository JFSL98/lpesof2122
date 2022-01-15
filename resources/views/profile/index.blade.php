@extends('layouts.app2')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">

                    <div class="" >
                        @if($user->id == Auth()->user()->id)
                        <a href="{{route("profile.upload_pic",$user->id)}}">
                        @endif
                        @if ($user->profile_pic==NULL)
                        <img class="profile-pic"  src="{{asset('storage/images/profile_pic/default.jpg')}}" alt="Avatar" class="rounded-circle" >
                        @else
                        <img class="profile-pic" src="{{asset('storage/images/profile_pic/'.$user->profile_pic->path)}}" alt="Avatar"class="rounded-circle" >
                        @endif
                    </div>
                </a>
                    <h1>
                        {{$user->name}}
                    </h1>
                    <small>{{$user->email}}<small>
                        @if($user->id != Auth()->user()->id)
                        @if(!Auth()->user()->isFollowing($user->id) && !Auth()->user()->UWvalidate($user->id))
                        <form action="{{route('friend.add',['friend_id' => $user->id, 'user'])}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Add Friend</button>
                        </form>
                        @elseif (Auth()->user()->UWvalidate($user->id))
                        <form action="{{route('friend.remove',['friend_id' => $user->id, 'user'])}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Remove Friend</button>
                        </form>
                        @elseif (Auth()->user()->isFollowing($user->id))
                        <form action="{{route('friend.remove',['friend_id' => $user->id, 'user'])}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-warning">Unfollow Friend</button>
                        </form>
                        @endif
                        @endif
                    </br>
                    friends: {{$user->getFriendsCount()}}
                    following: {{$user->getFollowingsCount()}}
                </div>
            </div>

            @if (session('status'))
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                </div>
            </div>
            @endif

            @if ($user->id == Auth()->user()->id)
            @include('partials.createpost')
            @endif
            @include('partials.listposts')
        </div>
    </div>


</div>



@endsection
