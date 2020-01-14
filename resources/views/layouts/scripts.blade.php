<!-- SCRIPTS -->
<!-- JQuery -->

<script></script>

<script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>

<script src="{{ asset('js/all.js') }}"></script>
{{--<!-- Bootstrap core JavaScript -->--}}
{{--<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>--}}
<!-- MDB core JavaScript -->
<script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jQuery-plugin-progressbar.js') }}"></script>


<!-- Initializations -->
<script type="text/javascript">

    $(document).ready(function(){
        $("#notification-dropdown").on('click', function(){
            $("#this-badge").fadeOut('fast');
        })
    });
    // Animations initialization
    new WOW().init();
    $(function() {
        $(".meter-round .meter-finish").each(function() {
            $(this)
                .data("origWidth", $(this).width())
                .width(0)
                .animate({
                    width: $(this).data("origWidth")
                }, 1000);
        });
    });
</script>

