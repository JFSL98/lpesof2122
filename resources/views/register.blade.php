@extends('layout.master')

@section('title')
Rede Alumni | Registration
@endsection

@section('content')
<!--register form-->
<div class="container-lg d-flex justify-content-center align-items-center vh-100 text-center">
    <!--card-->
    <div class="card card">
        <div class="card-header">
            <h2>Registar</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                @csrf
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nome" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                        required>
                </div>
                <div class="form-group">
                    <label for="password-confirm">Confirmar Password</label>
                    <input type="password" class="form-control" id="password-confirm" name="password_confirmation"
                        placeholder="Confirmar Password" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Registar</button>
                </div>
            </form>
        </div>
    </div>
    <!--/card-->
</div>
</div>
<!--/register form-->

@include('includes.footer')
@endsection
