
var url = 'https://adsd2019.clow.nl/ondernemer/';
$(document).ready(function() {

    $('#news-send').click(function(e){
        e.preventDefault();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        var data = {
            _token: CSRF_TOKEN,
            publisher_id: $('.news-publisher_id').val(),
            user_id: $('.news-user_id').val(),
            body: $('.news-body').val()
        };

        //"http://localhost:8000/admin/assignments/add-assignment"
        $.ajax({
            type: "POST",
            url: url + "nieuws/store",
            data: data,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                createNews(data);
                console.log(data);
                $('.news-empty').val('');
            }, error: function (xhr, textStatus, errorThrown) {
                console.log('failed');
            }
        })
    });

    $(document).on("keypress", ".comment-submit", function (e) {
        if(e.which == 13 && !e.shiftKey) {
            //$(this).closest("form").submit();
            e.preventDefault();

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            var data = {
                _token: CSRF_TOKEN,
                post_id: $(this).closest(".find-comment").find('.post_id').val(),
                user_id: $(this).closest(".find-comment").find('.user_id').val(),
                component_id: $(this).closest(".find-comment").find('.component_id').val(),
                body:$(this).closest(".find-comment").find(".comment-body").val(),
            };

            $.ajax({
                type: "POST",
                url: url + "nieuws/comment",
                data: data,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    //createNews(data);
                    console.log(data);
                    $(this).val('');
                }, error: function (xhr, textStatus, errorThrown) {
                    console.log('failed');
                }
            })
        }
    });


});

function createNews(data)
{
    $( ".me-news-wrap:eq(1)" ).before(
        $("<div>").attr("class", "me-news-wrap").append(
            $("<div>").attr("class", "news-card blue-shadow").append(
                $('<div>').attr("class", "full-flex flex-column uploader bg-white").append(
                    $('<div>').attr("class", "uploader-content flex-column p-0").append(
                        $('<div>').attr("class", "news-header-wrap").append(
                            $('<div>').attr("class", "d-flex news-thumb").append(
                                //default/user icon.png
                                $('<img>').attr({src: url + "uploads/avatar/" + ((data.user.file) ? data.user.id + '/' + data.user.file : 'default/user icon.png'), class: "img-thumbnail "})
                            )
                        ).append(
                            $('<div>').attr("class", "news-header").append(
                                $('<span>').attr("class", "news-name").html(data.user.name + " " + data.user.lastname)
                            ).append(
                                $('<span>').attr("class", "grey-text").append(
                                    $('<i>').attr("class", "far fa-clock ft-9").text(' Zojuist bericht geplaatst')
                                )
                            )
                        )
                    ).append(
                        $('<div>').attr("class", "news-content").append(
                            $('<div>').attr({class: "text ft-20 py-3 px-2", style: 'white-space: pre-line;'}).html(data.post.body)
                        )
                    ).append(
                        $('<div>').attr("class", "news-comment").append(
                            $('<a>').attr("class", "comment-link").append(
                                $('<i>').attr("class", "far fa-thumbs-up")
                            ).append(
                                $('<span>').html('Thumb up')
                            )
                        ).append(
                            $('<a>').attr("class", "comment-link").append(
                                $('<i>').attr("class", "far fa-comment-alt")
                            ).append(
                                $('<span>').html('Opmerking')
                            )
                        )
                    ).append(
                        $('<div>').attr("class", " find-comment d-flex justify-content-between border-top align-items-center px-3 pt-3").append(
                            $('<input>').attr({class: "user_id", type: "hidden", value: data.user_id})
                        ).append(
                            $('<input>').attr({class: "post_id", type: "hidden", value: data.post_id})
                        ).append(
                            $('<div>').attr("class", "form-group purple-border full-flex m-0").append(
                                $('<textarea>').attr({row: '1', name: "comment",
                                    cols: "50",
                                    class: "form-control news-change  p-2 comment-body comment-submit",
                                    placeholder: "Schrijf een opmerking..."  })
                            )
                        )
                    )
                ).append(
                    $('<small>').attr("class", "grey-text small-text").html('Druk op enter om te plaatsen')
                )
            )
        )
    );
}
