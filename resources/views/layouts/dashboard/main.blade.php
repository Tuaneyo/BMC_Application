<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.partials.header')
    <link href="{{ asset('css/datetimepicker.css') }}" rel="stylesheet" type="text/css"/>
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
<script type="text/javascript" charset="utf8" src="{{ asset('js/rating.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/general.js') }}"></script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.0/moment-with-locales.min.js"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('js/DataTables/datatables.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('js/dataTables.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/datetimepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/assignment.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/user.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/news.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/news-manage.js') }}"></script>


<script type="text/javascript">
    $(document).ready( function () {
        $('#picker').dateTimePicker();
    })

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

</script>
</body>
</html>
