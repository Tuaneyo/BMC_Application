
$(document).ready(function() {
    $('.all-user-icon').each(function () {
        var hue = 'rgb(' + (Math.floor((256-199)*Math.random()) + 50) + ',' + (Math.floor((256-199)*Math.random()) + 50) + ',' + (Math.floor((256-199)*Math.random()) + 50) + ')';
        $(this).css("background-color", hue);
    });

    var bg = $('.all-user-icon:eq(0)').css('background-color');
    $('.block-user-icon').css({'background-color': bg});

    $('.getUser').click(function(e){
        e.preventDefault();
        var formIndex = $('.getUser').index(this);

        var bg = $(".all-user-icon:eq( " + formIndex +" )").css('background-color');
        $('.block-user-icon').css({'background-color': bg});
        //$(".users-form:eq( " + formIndex +" )" ).submit();

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        var data = {
            _token: CSRF_TOKEN,
            id: $(".user_id:eq( " + formIndex +" )" ).val()
        };
        //""http://127.0.0.1:8000/reply/store
        $.ajax({
            type: "post",
            url: "https://adsd2019.clow.nl/ondernemer/getUser",
            data: data,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                console.log(data);
                setUser(data);
            }, error: function (xhr, textStatus, errorThrown) {
                console.log('failed');
            }
        })
    });

    function setUser(d)
    {
        console.log(d.user.id);
        $('#st_number').html(d.user.st_number);
        if(d.user.company == null){
            $('#company_name').html("n.v.tsdf");
        }else{
            $('#company_name').html(d.user.company);
        }

        $('#username').html(d.user.name + " " + d.user.lastname);
        $('#total').html(d.doneInt);
        $('#userid').attr('href', '/ondernemer/profile/' + d.user.id);

        $('#percentage').css({'width': d.perc + '%'});

    }


    var height = $('#wrap-info').innerHeight();
    $('.all-user-wrap').css({'height': (height -52) + 'px'});

    // Bug fixed bu settimeut document than read the height
    $('#people-tab').on('click', function(){
        setTimeout(function(){
            var height = $('#wrap-info').innerHeight();
            $('.all-user-wrap').css({'height': (height -52) + 'px'});
        },200);



    });


});

