@extends('website.layout.layout')

@section('css')
    <link href="{{ url('/assets/css/signin.css') }}" rel="stylesheet">
    <style>
        footer {
            display: none;
        }
        .navbar {
            display: none;
        }
    </style>
@endsection

@section('content')

  <main class="form-signin">
    <form method="post" action="{{ url('/login-post') }}">
      <img class="mb-4" src="{{ url('/imgs/logo.png') }}" style="width:auto; height:100px">
      <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
        @csrf
        @if(Session::has('errors'))
            <div class="alert alert-danger">
                {{ Session::get('errors') }}
            </div>
        @endif
      <div class="form-floating">
        <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
      </div>
      <div class="form-floating">
        <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div>
      <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
      <a href="{{ url('/') }}" class="w-100 btn btn-lg btn-outline-secondary mt-2" >Return to home</a>
    </form>
  </main>

@endsection
