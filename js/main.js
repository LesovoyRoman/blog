
$('.content-post').next().children().css({'width':'100%', 'color': 'white'});
$('.content-post').next().css({'width':'100%', 'color': 'white'});


$('.inbox').on('click', function () {
    $('.nav-tabs').children().removeClass('active');
    $(this).parent().addClass('active');
    $('.outbox-messages').hide(200);
   $('.inbox-messages').show(300);
});
$('.outbox').on('click', function () {
    $('.nav-tabs').children().removeClass('active');
    $(this).parent().addClass('active');
    $('.inbox-messages').hide(200);
    $('.outbox-messages').show(300);
});


// LIKES
$('.badge-like').on('click', function (e) {
    e.preventDefault();
    var curr_badge = $(this).val();
    var curr_b = $(this);
    $.ajax ({
        url: 'requestHelpers/like.php',
        data: {
            'post_id' : $(this).val()
        },
        type: 'POST',
        success: function result() {
            $(curr_b).fadeOut(10, function () {
                $(this).load(window.location.href +" .like"+curr_badge).fadeIn().css({'margin':'0', 'background':'transparent', 'padding':'0'}).delay(10);
            });
        }
    });
});
$('.badge-hover').mouseenter(
    function() {
        $(this).css('background','rgb(77, 94, 125)')
    }).mouseleave(
    function () {
        $(this).css('background','#777')});



// COMMENTS
$('.submit-comment').on('click', function (e) {
    e.preventDefault();
    var curr_this = $(this);
    var comment = $(this).parent().children('.text-comment').val();
    var id_comment = $(this).parent().next('.id_post').val();
    $.ajax ({
        url: 'index.php',
        data: {
            'comment': comment,
            'id_post' : id_comment
        },
        type: 'POST',
        success: function complete() {
            $(curr_this).parent().parent().parent().children('.comment-holder').css('display', 'none');
            $(curr_this).parent().parent().parent().children('.comment-holder').last().load(window.location.href + " #comment"+id_comment).fadeIn(300);
            $('.text-comment').val('');
        }
    });

});

