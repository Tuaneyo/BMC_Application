
$(document).ready(function() {


    $("#add-assigment").click(function(e){
        e.preventDefault();
        $(this).toggleText('<span><i class="fas fa-minus"></i></span><span>Opdracht verwijderen</span>','<span><i class="fas fa-plus"></i></span><span>Opdracht toevoegen</span>');
        //var index =$(".replyToggle").index($(this));
        $("#addAssigment-form").toggle(function() {
            $(this).css({'opacity': '1'})
        });
    });

    $('#addAssigment-btn').click(function(e){
        e.preventDefault();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        var data = {
            _token: CSRF_TOKEN,
            component_id: $('.component_id').val(),
            description: $('.assigment-area').val()
        };

        //"http://localhost:8000/admin/assignments/add-assignment"
        $.ajax({
            type: "POST",
            url: "https://adsd2019.clow.nl/ondernemer/admin/opdrachten/toevoegen",
            data: data,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                createAssignments(data);
                $('.feedback-area').val('');
            }, error: function (xhr, textStatus, errorThrown) {
                console.log(xhr);
            }
        })
    });

    $(document).on('click','.assiggnment-times', function(){

        var formIndex = $('.assiggnment-times').index(this);
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        var data = {
            _token: CSRF_TOKEN,
            adid: $('.adid:eq(' + formIndex + ')').val()
        };
        $.ajax({
           type: "POST",
           url:  "https://adsd2019.clow.nl/ondernemer/admin/opdrachten/verwijderen",
           data: data,
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                deleteAssignment(data, formIndex);
            }, error: function (xhr, textStatus, errorThrown) {
                console.log('gefald');
            }
        });
    });

    // Function to create assignment description block
    function createAssignments(data)
    {

        $('#assignment-box').append(
            $("<div>").attr("class", "assigment mt-2").text(data.description).append(
                $("<input>").attr({type: "hidden", value: data.id, class: "adid"}),
                $("<span>").attr("class", "assiggnment-times").append(
                    $("<i>").attr("class", "fas fa-times")
                )
            )
        );
    }

    // Function to delete assignment description block
    function deleteAssignment(data, i){
        if(data == 'true'){
            $('.assigment:eq('+ (i + 1) +')').fadeOut('normal', function () {
                $(this).remove();
            })
        }else{
            console.log('Oop cannot be deleted')
        }
    }


});


jQuery.fn.extend({
    toggleText: function (a, b){
        var that = this;
        if (that.html() != a && that.html() != b){
            that.html(a);
        }
        else
        if (that.html() == a){
            that.html(b);
        }
        else
        if (that.html() == b){
            that.html(a);
        }
        return this;
    }
});

