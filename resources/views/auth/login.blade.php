@extends('layouts.app')

@section('content')
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
@if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                @if(!$loop->first)
                    <br>
                @endif
                {{ $error }}
            @endforeach
        </div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class=" d-flex justify-content-center form-group row mb-0">
                            <div class="col-md-8">
                                <a href="login/google" class="btn btn-outline-secondary btn-lg btn-block">
                                    Login with Google
                                </a>
                                <a href="login/twitter" class="btn btn-outline-secondary btn-lg btn-block">
                                    Login with Twitter
                                </a>
                                <a href="login/github" class="btn btn-outline-secondary btn-lg btn-block">
                                    Login with Github
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
