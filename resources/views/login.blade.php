@extends('layout.master')

@section('title')
Rede Alumni | Login
@endsection

@section('content')
    <!--- Login form -->
    <div class="container-lg d-flex justify-content-md-center align-items-center vh-100 text-center">
        <!--card-->
        <div class="card">
            <div class="card-header">
                <h2>Login</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    @csrf
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="{{ old('email') }}" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Senha" required>
                    </div>
                    <div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
                    </label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                    <a href="#" class="forgot-password">
                    Forgot the password?
                    </a>
                </form>
            </div>
        </div><!-- /card-container -->
    </div><!-- /container -->

    @include('includes.footer')
@endsection