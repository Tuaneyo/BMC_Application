<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.partials.header')
</head>
<body>
<div id="app">
    @include('layouts.partials.hamburger')
    @if (session('status'))
        <div class="alert alert-success d-alert" role="alert">
            {{ session('status') }}
        </div>
    @elseif(session('danger'))
        <div class="alert alert-danger d-alert" role="alert">
            {{ session('danger') }}
        </div>
    @endif
    @yield('content')
</div>
@include('layouts.scripts')
<script src="{{ asset('js/all.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/user.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/account-user.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/news-manage.js') }}"></script>
<script>

    $(".progress-bar1").loading();
    $(document).ready( function () {
        $('.progress-bar1 div span:eq(0)').css({'background-color': 'white'});
        $('.nav-item').each(function(){
            $(this).removeClass('waves-light');
            $(this).removeClass('waves-effect');
        });

    })

</script>
</body>
</html>
