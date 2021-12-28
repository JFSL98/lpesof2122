@extends('layouts.app2')

@section('title')
Rede Alumni | Post
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        @php
            $user=$post->user;
        @endphp
        <a  class="text-reset text-decoration-none" href="{{route("profile",$user->id)}}">
            @if ($user->profile_pic==NULL)
            <img class="rounded-circle profile-pic profile-pic-listposts" src="{{asset('storage/images/profile_pic/default.jpg')}}" alt="Avatar">
            @else
            <img class="rounded-circle profile-pic profile-pic-listposts" src="{{asset('storage/images/profile_pic/'.$user->profile_pic->path)}}" alt="Avatar" >
            @endif 
            <h5 class="card-title">{{ $post->user->name }}</h5>
        </a>
        <small>
            posted at {{ $post->created_at }}
            @if ($post->created_at != $post->updated_at)
                , edited at {{ $post->updated_at }}
            @endif
        </small>
    </div>
    <div class="card-body">
        <p class="card-text">{{ $post->content }}</p>
        @if ($post->user_id === Auth()->user()->id)
        <form method="POST" action="{{ route('post.remove', ['id' => $post->id]) }}">
            @csrf
            <button type="submit" class="btn btn-danger">Remover</button>
        </form>
        @endif
    </div>
</div>

@include('includes.footer')
@endsection
