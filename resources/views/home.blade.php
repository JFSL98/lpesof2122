@extends('layouts.app2')

@section('title')
Rede Alumni | Home
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Página Inicial') }}</div>
                @if (session('status'))
                <div class="card-body">
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                </div>
                @endif
            </div>
            @include('partials.createpost')
            @include('partials.listposts')
        </div>
    </div>
</div>
@endsection
