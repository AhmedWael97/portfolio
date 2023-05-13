<html lang="en">
    <head>
            <title>Refaat Photography</title>
            <!-- Meta Tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="author" content="refaat-photography.com">
            <meta name="description" content="Free born photography">

            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <link href="{{ url('/assets/css/heroes.css') }}" rel="stylesheet">

            @yield('css')

            <link href="{{ url('/assets/css/style.css') }}" rel="stylesheet">

    </head>
    <body>
        @include('website.partial.header')
        @yield('content')
        @include('website.partial.footer')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
