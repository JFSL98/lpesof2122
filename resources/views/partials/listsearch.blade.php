@extends('layouts.app2')

@section('title')
Rede Alumni | Search
@endsection

@section('content')

@if ($user_search == NULL)
<div class="card">
    <div class="card-body">
        <div class="alert alert-warning" role="alert">
            Não foram encontrados resultados!
          </div>
    </div>
</div>
    

@else
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Resultados da pesquisa</h5>
    </div>
    <div class="card-body">
        <div class="container">
            <div class="row">
                @foreach ($user_search as $user)
                <div class="col-md-3">
                    <a  class="text-reset text-decoration-none" href="{{route("profile",$user->id)}}">
                        @if ($user->profile_pic==NULL)
                        <img class="rounded-circle profile-pic profile-pic-listposts" src="{{asset('storage/images/profile_pic/default.jpg')}}" alt="Avatar">
                        @else
                        <img class="rounded-circle profile-pic profile-pic-listposts" src="{{asset('storage/images/profile_pic/'.$user->profile_pic->path)}}" alt="Avatar" >
                        @endif 
                        <h5 class="card-title">{{ $user->name }}</h5>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


@endif

@endsection
