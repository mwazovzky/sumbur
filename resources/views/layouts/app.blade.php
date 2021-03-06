<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sumbur</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .navbar { margin-bottom: 0; background-color: hsl(171, 100%, 41%); }
    </style>

    <!-- Pass Auth data to JavaScript -->
    <script>
        window.App = {!! json_encode([
            'user' => Auth::user(),
            'signedIn' => Auth::check(),
            'isAdmin' => Auth::check() && Auth::user()->isAdmin(),
        ]) !!};
    </script>

    @yield('header')
</head>
<body>
    <div id="app">
        @include('layouts.nav')
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
