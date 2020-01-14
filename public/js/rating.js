$( document ).ready(function() {

    $('#checkbox').on('change', function(){
        $('#checkbox-hidden').val(this.checked ? 2 : 1);
    });

    $('#checkbox-deadline').on('change', function(){
        $('#checkbox-hidden').val(this.checked ? 0 : 1);
        console.log($('#checkbox-hidden').val());
    });

});
