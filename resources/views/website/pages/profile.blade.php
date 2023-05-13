@extends('website.layout.layout')
@section('content')
<div class="container mt-4">
    <h1>Welcome, {{ auth()->user()->name }}</h1>
    <a href="{{ url('/logout') }}" class="btn btn-primary">
        Log out
    </a>
    <hr>
    <div class="row">
        <div class="col-12">
            <h3>
                Your Albums
            </h3>
        </div>

    </div>
</div>
@endsection
