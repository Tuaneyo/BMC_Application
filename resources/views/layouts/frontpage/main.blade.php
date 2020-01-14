<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.partials.header')
</head>
<body>
    <div id="app">
        @include('layouts.partials.hamburger')
        @include('layouts.frontpage.main-nav')
        <div class="">
            @yield('content')
        </div>
    </div>
    @include('layouts.scripts')
    <script>
        $(".progress-bar1").loading();
        $(document).ready(function(){
            $('.progress-bar1 div span:eq(0)').css({'background-color': 'goldenrod'});
            $('.progress-bar1 div span:eq(1)').css({'background-color': '#8c8c8c'});
            $('.progress-bar1 div span:eq(2)').css({'background-color': '#cd7f32'});
            $('.progress-bar1 div span:eq(3)').css({'background-color': '#3463e8'});

        });

    </script>



</body>
</html>
