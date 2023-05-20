@extends('website.layout.layout')
@section('content')

<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"
/>

<div class="container mt-4">
    <h1>Welcome, {{ auth()->user()->name }}'s Family</h1>
    <a href="{{ url('/') }}" class="btn btn-primary">
        Home
    </a>
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

    <div class="downloadBar" style="display: none">
        <p class="downloadBarTitle">Downloading ...</p>
        <div class="progress mb-4">
            <div class="progress-bar  bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
        </div>
    </div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        @foreach(auth()->user()->albums as $key=>$album)
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $key == 0 ? 'active' : '' }}" id="btn-{{ $album->id }}" data-bs-toggle="tab" data-bs-target="#tab-{{ $album->id }}" type="button" role="tab" aria-controls="tab-{{ $album->id }}" aria-selected="true">
                {{ $album->name }}
            </button>
        </li>
        @endforeach

    </ul>
      <div class="tab-content" id="myTabContent">
        @foreach(auth()->user()->albums as $key=>$album)
            <div class="tab-pane fade mt-2 {{ $key == 0 ? 'show active' : '' }}" id="tab-{{ $album->id }}" role="tabpanel" aria-labelledby="tab-{{ $album->id }}">
                <p>
                    <button type="button" album-id="{{ $album->id }}" class="btn btn-primary btn-sm downloadAlbum"> Download Album </button>
                </p>
                @foreach($album->images as $image)
                <a href="{{ $image->photo }}" data-fancybox data-caption="{{ $album->name }}">
                    <img src="{{ $image->photo }}" style="width: auto; height:180px; margin:0.5px" />
                </a>

                @endforeach
            </div>
        @endforeach
      </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

<script>
    $(document).ready(function() {
        $('.downloadAlbum').click(function() {
            var albumId = $(this).attr('album-id');
            $('.downloadBar').css('display','block');
            var url = "{{ url('/getAlbumImages') }}/" + albumId;
            $.get(url,function(response){
                $totalImages = response.length;
                $('.progress-bar').css('width', '0%');
                    $('.progress-bar').html('0%');
                $.each(response,function(i,image) {
                    var imageUrl = "{{ url('/download-image/') }}/" + image;
                    var Counter = i+1;
                    var Precentage = Counter * (100 / $totalImages);

                    $('.progress-bar').css('width', Precentage + '%');
                    $('.progress-bar').html(Precentage + '%');
                    $.get(imageUrl,function(response) {
                        var link = $('<a>').attr('href', url);
                        link.attr('download', Math.floor(Math.random() * 10000) +'.jpg');
                        $('body').append(link);
                        link[0].click();
                        link.remove();
                    });

                    $('.downloadBarTitle').html('Downloaded');
                });
            });
        });
        Fancybox.bind("[data-fancybox]", {
        // Your custom options
        });
    });
</script>
@endsection
