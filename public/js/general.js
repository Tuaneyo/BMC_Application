$( document ).ready(function() {

    $('#upload-button').click(function(){
       $('#my-file').val('');
    });

    $('#my-file').change(function() {
        var filename = $('#my-file').val().replace("C:\\fakepath\\", "");
        $("#my-filename").attr("placeholder",  filename);

        if( $("#my-file").get(0).files.length != 0){
            $("#modal-btn").trigger('click');
            $('.modal-body-wrap').html("Je staat op het punt om <span class='font-weight-bold'>" + filename + "</span> in te leveren. ")
            console.log('here');
        }else{
            $("#my-filename").attr("placeholder",  'geen bestand geupload');
            console.log('no file');

        }
    });

    $('.donwload-link').click(function(e){
        var formIndex = $('.donwload-link').index(this);
        e.preventDefault();
        $(".download-form:eq( " + formIndex +" )" ).submit();
    });
    $(".question-check:eq(0)").addClass('active');
    $(".question-check").click(function() {

        if($(this).hasClass('active')){
            $(this).removeClass("active");
        }else{
            $(this).addClass("active");
        }

    });

});
