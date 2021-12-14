@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">

                    <div class="" >
                        <img class="profile-pic" src="{{asset('storage/images/profile_pic/'.auth()->user()->profile_pic)}}" alt="Avatar">
                    </div>
                    <h1>
                        {{$user->name}}
                    </h1>
                    <small>{{$user->email}}<small>
                </div>
            </div>
        </div>
    </div>


</div>



@endsection