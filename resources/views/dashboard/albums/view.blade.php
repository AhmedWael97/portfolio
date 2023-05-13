@extends('dashboard.partial.layout')
@section('content')
<section class="content mt-2">
   <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                <i class="fas fa-baby"></i> All Photos For Album : {{$user->name}}             
                </h3>
              </div>

              <div class="card-body">
              <div class="col-lg-12">
               <div class="row">
                 
                    @foreach($images as $image)
                      <div class="card col-lg-3">
                      <a id="single_image" data-fancybox="gallery" rel="group1" href="{{$image->photo}}" > <img src="{{$image->photo}}" alt="" style="width:100%;height:300px;"></a>
                      </div>
                    @endforeach
                 </div>
               </div>
            </div>
          </div>
      </div>
   </div>
</section>

@endsection