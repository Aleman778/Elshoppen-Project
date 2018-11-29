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
    $("#comment-msg").val("");
    $(this).attr("disabled", "disabled");
    addComment(message, 0, $("#comments"));
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
    var replies = $(this).parents(".comment").next();
    var selector = replies.children(".replies-div");
    div.hide();
    textarea.val("");
    replies.children(".show-reply-btn").hide();
    replies.children(".hide-reply-btn").show();
    selector.show();
    addComment(message, reply, selector);
});

function addComment(message, reply, selector) {
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
        selector.prepend(html);
    });
}