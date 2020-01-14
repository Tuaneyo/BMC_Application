
$(document).ready(function() {
    $('.user-card-header').each(function (index, value) {
        var hue = 'rgb(' + (Math.floor((256-199)*Math.random()) + 50) + ',' + (Math.floor((256-199)*Math.random()) + 50) + ',' + (Math.floor((256-199)*Math.random()) + 50) + ')';
        $(this).css("background-color", hue);
        $(".ran-bg-btn:eq("+ index +")").css("color", hue);
    });

    var bg = $('.all-user-icon:eq(0)').css('background-color');

    var max = 400;
    $('.max').keypress(function(e) {
        console.log(this.value.length);
        if (e.which < 0x20) {
            // e.which < 0x20, then it's not a printable character
            // e.which === 0 - Not a character
            return;     // Do nothing
        }
        if (this.value.length == max) {
            e.preventDefault();
        } else if (this.value.length > max) {
            console.log(this.value.length);
            // Maximum exceeded
            this.value = this.value.substring(0, max);
        }
    });

});

