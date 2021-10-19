<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" href="https://statistik.tangerangkab.go.id/photos/1/icon/people.png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- CSS --}}
    @stack('beforeCss')
    @include('includes.style')
    @stack('afterCss')
</head>

<body>
    <div id="auth">
        @yield('content')
    </div>

    {{-- script --}}
    @stack('beforeScript')
    @include('includes.script')
    @stack('afterScript')

    </body>
</html>
