@extends('website.layout.layout')
@section('content')
<div class="px-4  my-5 text-center border-bottom firstSection">
    <img src="{{ url('/imgs/logo.png') }}" style="width: autp; height:100px" />
    <h1 class="display-4 fw-bold">Refaat Photography</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">
        Newborn photography is the most difficult photography and we have got the right mindset, skills, and experience to handle the baby with utmost hygiene care and love.
      </p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-4">
        <a type="button" class="btn btn-primary btn-lg px-4 me-sm-3">Explore My Work On Instagram</a>
        <a href="{{ url('/login') }}" class="btn btn-outline-secondary btn-lg px-4">Login</a>
      </div>
    </div>
    <div class="overflow-hidden" style="max-height: 45vh;">
      <div class="container px-5">
        <img src="{{ url('/imgs/example.jpg') }}" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Example image" width="700" height="500" loading="lazy">
      </div>
    </div>
</div>
<div class="secondSection mt-3 mb-3 text-center">
    <h1 class="mb-4 font-heading"> My Previous <span class="mainColor">Work</span> </h1>

    <div class="mt-4">
        <div class="row p-0 m-0">
            @for($x=0;$x<8 ;$x++)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="{{ url('/imgs/example.jpg') }}" class="card-img-top shadow-sm" alt="...">
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>
<div class="thirdSection">
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
          <h1 class="display-5 fw-bold">About Me</h1>
          <p class="col-md-8 fs-4">
            Hi everyone! I am so glad you stopped by to find out more about me and my work!
          </p>
          <button class="btn btn-primary btn-lg" type="button">Call Me : +020123456789</button>
        </div>
      </div>
</div>
<div class="secondSection mt-3 mb-3 text-center">
    <h1 class="mb-4 font-heading"> Latest  <span class="mainColor">Projects</span> </h1>

    <div class="mt-4">
        <div class="row p-0 m-0">
            @for($x=0;$x<8 ;$x++)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="{{ url('/imgs/example.jpg') }}" class="card-img-top shadow-sm" alt="...">
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>
@endsection
