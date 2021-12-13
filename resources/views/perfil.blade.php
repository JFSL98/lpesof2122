@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">

                    <div class="" >
                        <img class="profile-pic"  src="https://i0.wp.com/post.medicalnewstoday.com/wp-content/uploads/sites/3/2020/03/GettyImages-1092658864_hero-1024x575.jpg?w=1155&h=1528"  alt="Avatar">
                    </div>
                    <h1>
                        {{Auth::user()->name}}
                    </h1>
                    <small>{{Auth::user()->email}}<small>
                </div>
            </div>
        </div>
    </div>


</div>



@endsection