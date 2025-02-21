@extends('website.layout.layout')
@section('content')
<div class="px-4  my-5 text-center border-bottom firstSection">
    <img src="{{ url('/imgs/logo.png') }}" style="width: autp; height:100px" />
    <h1 class="display-4 fw-bold">Refaat Photography</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">
       Newborn Photography is a part of portrait photography. The only speciality of this segment is that the subjects are generally less than two weeks of age. Newborn portraiture aims to capture beautiful moments of the newborn before the child grows up.
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
          
        

        <img src="https://lh3.googleusercontent.com/d/1QMJIpQtAJb9SsE3_HojfIH3SErN4Y1A5" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Example image" width="700" height="500" loading="lazy">
      </div>
    </div>
</div>
<div class="secondSection mt-3 mb-3 text-center">
    <h2 class="mb-4 font-heading" style="font-family: 'Kaushan Script', cursive;"> My Previous <span class="mainColor">Work</span> </h2>

    <div class="mt-4">
        <div class="row p-0 m-0">
               @foreach($previous_works as $previous_work)
               <div class="col-xs-6 col-sm-6 col-md-3 mb-4">
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
            <br>
            I’m Refaat Newborn Photographer 

I graduated from the Faculty of Art Education and a member of the Syndicate of Fine Artists.
<br>

As a photographer, my mission is to help you celebrate your life with natural photography that captures memories for you and your loved ones to share and cherish over the years.
<br>

My style is natural, fresh, and photojournalistic.
<br>

Thank you so much for stopping by and please feel free to contact me with any questions you might have.
          </p>
        </div>
      </div>
</div>



<div class="secondSection mt-3 mb-3 text-center">
    <h2 class="mb-4 font-heading"  style="font-family: 'Kaushan Script', cursive;"><span class="mainColor">Clients</span> </h2>

    <div class="mt-4">
        <div class="row p-0 m-0">
        <?php 
        $clients_images = App\Models\clients::orderBy('id','desc')->take(11)->get();
        $albums_no = 300+ App\Models\Album::count();
        ?>
               @foreach($clients_images as $clients_image)
                <div class="col col-xs-6 col-sm-6 col-md-1 col-lg-1 mb-4">
                    <div  style="overflow: hidden; justify-content:center; display:flex;border-radius:50%;height:100px;width:100px">
                        <img style="max-width:100%; height:auto; margin:auto" src="{{ $clients_image->image}}" class="card-img-top shadow-sm" alt="...">
                    </div>
                    

                </div>
               
               @endforeach
               <div class="col col-xs-6 col-sm-6 col-md-1 col-lg-1 mb-4">
               <div class="row position-relative" style="overflow: hidden; justify-content:center; display:flex;border-radius:50%;height:100px;width:100px">
               <div class="col position-absolute" style="width:100%;height:100%;background-color:rgba(0,0,0,0.7);color:white;padding:20px 5px;font-weight:bold;font-size:25px;font-family: 'Kaushan Script', cursive;"><p style="margin-top:11px;">+{{$albums_no}}</p></div>
    </div>
               </div>
             


        </div>
    </div>
</div>
@endsection
