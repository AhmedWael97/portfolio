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
        <a target="_blank" href="https://www.instagram.com/refaatphotography/" type="button" class="btn btn-primary btn-lg px-4 me-sm-3">Explore My Work On Instagram</a>
        @if(Auth::check())
            <a href="{{ url('/profile') }}" class="btn btn-outline-secondary btn-lg px-4">My Profile</a>
        @else
            <a href="{{ url('/web-login') }}" class="btn btn-outline-secondary btn-lg px-4">Login</a>
        @endif
      </div>
    </div>
    <div class="overflow-hidden" style="max-height: 45vh;">
      <div class="container px-5">
        <img src="https://drive.google.com/uc?id=1PXdkr5CZw8lBiX-yq51U_B_w7GZvmBHg" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Example image" width="700" height="500" loading="lazy">
      </div>
    </div>
</div>
<div class="secondSection mt-3 mb-3 text-center">
    <h2 class="mb-4 font-heading" style="font-family: 'Kaushan Script', cursive;"> My Previous <span class="mainColor">Work</span> </h2>

    <div class="mt-4">
        <div class="row p-0 m-0">
               @foreach($previous_works as $previous_work)
               <div class="col-md-3 mb-4">
                <div  style="overflow: hidden; justify-content:center; display:flex">
                    <img style="max-width:100%; height:auto" src="{{ $previous_work->image}}" class="card-img-top shadow-sm" alt="...">
                </div>
            </div>
               @endforeach
        </div>
    </div>
</div>
<div class="thirdSection">
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
          <h1 class="display-5 fw-bold"  style="font-family: 'Kaushan Script', cursive;">About Me</h1>
          <p class="col-md-8 fs-4">
            Hi everyone! I am so glad you stopped by to find out more about me and my work!
          </p>
        </div>
      </div>
</div>
<div class="secondSection mt-3 mb-3 text-center">
    <h2 class="mb-4 font-heading"  style="font-family: 'Kaushan Script', cursive;"> Latest  <span class="mainColor">Projects</span> </h2>

    <div class="mt-4">
        <div class="row p-0 m-0">
               @foreach($latest_works as $latest_work)
                <div class="col-md-3 mb-4">
                    <div  style="overflow: hidden; justify-content:center; display:flex">
                        <img style="max-width:100%; height:auto" src="{{ $latest_work->image}}" class="card-img-top shadow-sm" alt="...">
                    </div>
                </div>
               @endforeach

        </div>
    </div>
</div>

<div class="secondSection mt-3 mb-3 text-center">
    <h2 class="mb-4 font-heading"  style="font-family: 'Kaushan Script', cursive;"><span class="mainColor">Clients</span> </h2>

    <div class="mt-4">
        <div class="row p-0 m-0">
               @foreach($latest_works as $latest_work)
                <div class="col-md-1 mb-4">
                    <div  style="overflow: hidden; justify-content:center; display:flex;border-radius:50px;height:100px;width:100px;">
                        <img style="max-width:100%; height:auto;" src="{{ $latest_work->image}}" class="card-img-top shadow-sm" alt="...">
                    </div>

                </div>
               @endforeach


        </div>
    </div>
</div>
@endsection
