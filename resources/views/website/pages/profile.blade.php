@extends('website.layout.layout')
@section('content')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #progress-container {
            width: 100%;
            background: lightgray;
        }



        .notification-item {}

        .time {
            display: block;
            float: right;
            margin-top: 5px;
            color: #5a5858;
            padding: .25rem 1rem;
        }

        .noti-padding {
            padding: .25rem 1rem;
        }

        .bg-grey {
            background: #eeeeee;
        }

        .fas {
            color: #534733 !important;
        }
    </style>
    <div class="container mt-4">


        <div class="alert alert-success success d-none">

            Your file is cooking now, it might take some time due to images for best quailty.

        </div>

        <div class="not-cont">
            @include('website.pages.notifications')
        </div>
        <br />
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


        <ul class="nav nav-tabs" id="myTab" role="tablist">
            @foreach(auth()->user()->albums as $key => $album)
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $key == 0 ? 'active' : '' }}" id="btn-{{ $album->id }}" data-bs-toggle="tab"
                        data-bs-target="#tab-{{ $album->id }}" type="button" role="tab" aria-controls="tab-{{ $album->id }}"
                        aria-selected="true">
                        {{ $album->name }}
                    </button>
                </li>


            @endforeach

        </ul>
        <div class="tab-content" id="myTabContent">

            @foreach(auth()->user()->albums as $key => $album)
                <div class="tab-pane fade mt-2 {{ $key == 0 ? 'show active' : '' }}" id="tab-{{$album->id}}" role="tabpanel"
                    aria-labelledby="tab-{{ $album->id }}">
                    <p>
                        <button data-href="{{ route('zip', $album->id) }}" id="{{$album->id}}"
                            class="btn btn-primary btn-sm downloadAlbum"> Download Album </button>
                    </p>
                    <div class="content-id-{{$album->id}}"></div>

                </div>
            @endforeach
        </div>


    </div>

    <script src="{{ asset('assets/jquery/jquery.js') }}"></script>
    {{--
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script> --}}

    <script>
        $(document).ready(function () {




            var tab_id = $('.active').attr("id");
            values = tab_id.split('-');
            one = values[0];
            id = values[1];
            if ($(".content-id-" + id).children("a").length > 0) {
                console.log('Parent div has child divs');
            } else {
                $.get('{{ url("/") }}/get-albums-images/' + id, function (response) {

                    $('.content-id-' + id).html(response);
                });
            }



            $('.nav-link').click(function () {
                var tab_id = $('.active').attr("id");
                values = tab_id.split('-');
                one = values[0];
                id = values[1];
                if ($(".content-id-" + id).children("a").length > 0) {
                    console.log('Parent div has child divs');
                } else {
                    $.get('{{ url("/api") }}/get-albums-images/' + id, function (response) {

                        $('.content-id-' + id).html(response);
                    });
                }

            })


            $('.downloadAlbum').click(function () {
                var id = $(this).attr('id');
                $(this).text("Downloading your album ...");
                $(this).prop('disabled', true);

                var url = $(this).attr('data-href');

                $.get(url, function (response) {
                    $(".success").removeClass('d-none');
                    $(this).text("Download Album");
                    $(this).prop('disabled', false);
                });

                check_for_updates();
            });

            function check_for_updates() {

                let noti_checker = setInterval(function () {

                    $.get("{{ url('new_notification') }}", function (response) {

                        if (response['found'] == "1") {
                            var data = response['data'];
                            $('.not-cont').empty();
                            $('.not-cont').html(data);
                            clearInterval(noti_checker);
                        } 
                    });
                }, 5000);
            }

            $('.make_me_read').click(function () {
                var not_id = $(this).attr('data-not-id');
                $.get('{{ url("/make-me-read") }}/' + not_id, function (response) {
                    var data = response['data'];
                    $('.not-cont').empty();
                    $('.not-cont').html(data);
                });
            });
        });
    </script>
@endsection