<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Vue Router Message Example From Scratch - ItSolutionStuff.com</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
    <h1>Test blog </h1>
</div>
<div id="app">
</div>
<script src="{{ mix('js/app.js') }}"></script>

</body>
</html>
