<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- CSRF Token -->

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'project laboratorium') }}</title>

    <!-- mdbootstrap links style -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('css/style.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />


    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">


</head>
<body style="background-color: #555fb3;">
    @if (session('status'))
        <div class="alert alert-success d-alert" role="alert">
            {{ session('status') }}
        </div>
    @endif
    @yield('content')
    <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/all.js') }}"></script>
</body>
</html>
