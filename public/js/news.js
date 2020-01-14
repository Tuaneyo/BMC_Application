
$(document).ready(function() {
    $(document).on('input','.news', function(){
        var myText = $(this).val().length;
        var btnIndex = $('.news').index(this);
        if(myText > 1){
            $('.news-btn:eq('+ btnIndex + ')').attr('disabled', false)
        }else{
            $('.news-btn:eq('+ btnIndex +')').attr('disabled', true)
        }

        if(myText > 100){
            $(this).css({'font-size': '15px'});
        }else if(myText > 50 && myText < 100){
            $(this).css({'font-size': '18px'});
        }else{
            $(this).css({'font-size': '20px'})
        }
    });

    $(document).on('click','.news-change', function(){
        var h = $(this).height();
        var index = $('.news-change').index(this);
        console.log(index);
        $(this).keyup(function(e) {
            $(this).height(h);
            $(this).height(this.scrollHeight + parseFloat($(this).css("borderTopWidth")) + parseFloat($(this).css("borderBottomWidth")));
        });
    });


});

