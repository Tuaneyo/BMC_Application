<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- CSRF Token -->

<meta name="userId" content="{{ Auth::user()->id }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'project laboratorium') }}</title>

<!-- mdbootstrap links style -->
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />

<link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet" />

<link href="{{ asset('css/style.min.css') }}" rel="stylesheet" />

<link href="{{ asset('css/style.css') }}" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css') }}" />

<!-- Fonts -->
{{--<link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--<link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">--}}
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

<!-- font-family: 'Arimo', sans-serif; -->
<style type="text/css">
    html,
    body,
    header,
    .pager {
        height: 30vh;
    }

    @media (max-width: 740px) {

        html,
        body,
        header,
        .pager {
            height: 40vh;
        }
    }

    @media (min-width: 800px) and (max-width: 850px) {

        html,
        body,
        header,
        .pager {
            height: 40vh;
        }
    }


</style>
