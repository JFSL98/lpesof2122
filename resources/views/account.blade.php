@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-6">
            <!-- logotipo UFP -->
            <a href="/"><img src="{{ asset('images/UFP-Logo.png') }}" alt="logotipo UFP" class="img-fluid"></a>
        </div>
        <div class="col">
            <h5 class="card-title">Bem-vindo!</h5>
            <a class="btn" href="{{ route('login') }}" role="button">Login</a>
            <a class="btn" href="{{ route('register') }}" role="button">Registar</a>
        </div>
    </div>
@endsection
