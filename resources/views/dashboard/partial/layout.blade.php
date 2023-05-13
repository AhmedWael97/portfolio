<!DOCTYPE html>
<html>
    <head>
        @include('dashboard.partial.header')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('dashboard.partial.sidenav')

        <div class="content-wrapper">
            @include('dashboard.partial.sessions')
            @yield('content')
        </div>

        @include('dashboard.partial.scripts')
        @yield('script')
        
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    </body>
</html>
