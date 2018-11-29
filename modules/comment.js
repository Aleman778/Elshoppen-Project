$("#comment-msg").keyup(function() {
    if ($(this).val().length == 0) {
        $("#comment-btn").attr("disabled", "disabled");
    } else {
        $("#comment-btn").removeAttr("disabled");
    }
});

$(document).on('keyup', '.reply-msg', function(e) {
    var replybtn = $(this).attr("target");
    if ($(this).val().length == 0)
        $("#" + replybtn).attr("disabled", "disabled");
    else
        $("#" + replybtn).removeAttr("disabled");
});

$("#comment-btn").click(function() {
    var message = $("#comment-msg").val();
    alert("Sending: " + message);
    addComment(message, 0);
    
});

$(document).on('click', '.reply-btn', function(e) {
    $(this).next(".write-reply-div").toggle();
});

$(document).on('click', '.show-reply-btn', function(e) {
    $(this).hide();
    $(this).next().show();
    $(this).siblings(".replies-div").show();
});

$(document).on('click', '.hide-reply-btn', function(e) {
    $(this).hide();
    $(this).prev().show();
    $(this).siblings(".replies-div").hide();
});

$(document).on('click', '.cancel-reply-btn', function(e) {
    var textarea = $(this).siblings("div").children("textarea");
    var div = $(this).parents(".write-reply-div");
    div.hide();
    textarea.val("");
});

$(document).on('click', '.send-reply-btn', function(e) {
    var textarea = $(this).siblings("div").children("textarea");
    var message = textarea.val();
    var reply = $(this).attr("to");
    var div = $(this).parents(".write-reply-div");
    div.hide();
    textarea.val("");
    addComment(message, reply);
});

function addComment(message, reply) {
    var product = $("#comment-btn").attr("product");

    $.ajax({
        method: "POST",
        url: "/modules/add_comment.php",
        data: {
            product_id: product,
            reply_id: reply,
            comment: message
        }
    }).done(function(html) {
        if (html == "Error!") {
            html = '<div class="alert alert-primary" role="alert">' +
                   '    Something went wrong when sending your comment, please try again.' +
                   '</div>';
        }
        $("#comments").prepend(html);
    });
}