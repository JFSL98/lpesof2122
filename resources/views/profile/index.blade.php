@extends('layouts.app2')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">

                    <div class="" >
                        <img class="profile-pic" src="{{asset('storage/images/profile_pic/'.$user->profile_pic)}}" alt="Avatar">
                    </div>
                    <h1>
                        {{$user->name}}
                    </h1>
                    <small>{{$user->email}}<small>
                </div>
            </div>
            @if ($user == Auth()->user())
            @include('partials.createpost')
            @endif
            @include('partials.listposts')
        </div>
    </div>


</div>



@endsection