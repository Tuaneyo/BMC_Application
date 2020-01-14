$( document ).ready(function() {
    var msg = $('.d-alert');
    if(msg.length){
        $('.alert').css({'right':0, 'transition': 'all  .7s', '-webkit-transition': 'all .7s'});
        setTimeout(function(){
            $('.alert').fadeOut('slow');
        }, 7000);
    }
});
