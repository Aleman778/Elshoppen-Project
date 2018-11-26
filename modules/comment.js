$("#comment-msg").keyup(function() {
    if ($(this).val().length == 0) {
        $("#comment-btn").attr("disabled", "disabled");
    } else {
        $("#comment-btn").removeAttr("disabled");
    }
});

$(".reply-msg").keyup(function() {
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

$(".reply-btn").click(function() {
    $(this).next(".write-reply-div").toggle();
});

$(".show-reply-btn").click(function() {
    $(this).hide();
    $(this).next().show();
    $(this).siblings(".replies-div").show();
});

$(".hide-reply-btn").click(function() {
    $(this).hide();
    $(this).prev().show();
    $(this).siblings(".replies-div").hide();
});

$(".cancel-reply-btn").click(function() {
    var textarea = $(this).siblings("div").children("textarea");
    var div = $(this).parents(".write-reply-div");
    div.hide();
    textarea.val("");
});

$(".send-reply-btn").click(function() {
    var textarea = $(this).siblings("div").children("textarea");
    var message = textarea.val();
    var reply = $(this).attr("to");
    var div = $(this).parents(".write-reply-div");
    div.hide();
    textarea.val("");
    alert("Sending: " + message + " to comment id= " + reply);
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
        alert(html);
    });
}