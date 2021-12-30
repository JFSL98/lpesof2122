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
                <div class="col-md-4">
                    <i class="btn btn-primary far fa-comment"> {{ $commentcount }}</i>
                </div>
                <div class="col-md-4">
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
