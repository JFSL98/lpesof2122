@extends('layouts.app2')

@section('title')
Rede Alumni | Post
@endsection

@section('content')

@if ($post == NULL)
<div class="card">
    <div class="card-body">
        <div class="alert alert-warning" role="alert">
            Este post não existe!
          </div>
    </div>
</div>
    

@else
@php
$likes = $post->likes;
$like = $likes->where('user_id', '=', Auth()->user()->id)->first();
@endphp
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
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <form method="POST" action="{{ route('post.like', ['id' => $post->id, 'like_dislike' => true]) }}">
                        @csrf
                        @if($like == NULL||$like->like_dislike==0)
                        <input type="submit" class="btn btn-primary fas fa-thumbs-up" value="&#xf164; {{ $post->getLikeCount() }}">
                        @else
                        <input type="submit" class="btn btn-success fas fa-thumbs-up" value="&#xf164; {{ $post->getLikeCount() }}">
                        @endif
                    </form>
                </div>
                <div class="col-md-3">
                    <form method="POST" action="{{ route('post.like', ['id' => $post->id, 'like_dislike' => false]) }}">
                        @csrf
                        @if ($like == NULL||$like->like_dislike==1)
                        <input type="submit" class="btn btn-primary fas fa-thumbs-down" value="&#xf165; {{ $post->getDislikeCount() }}">
                        @else
                        <input type="submit" class="btn btn-danger fas fa-thumbs-down" value="&#xf165; {{ $post->getDislikeCount() }}">
                        @endif
                    </form>
                </div>
                <div class="col-md-3">
                    <i class="btn btn-primary far fa-comment"> {{ $commentcount }}</i>
                </div>
                <div class="col-md-3">
                    @if ($post->user_id === Auth()->user()->id)
                    <form method="POST" action="{{ route('post.remove', ['id' => $post->id]) }}">
                        @csrf
                        <input type="submit" class="btn btn-danger fas fa-trash-alt" value="&#xf2ed;">
                    </form>
                    @endif
                </div>
            </div>
        </div>
        
    </div>
</div>

@include('partials.createcomment')
@include('partials.listcomments')

@endif

@endsection
