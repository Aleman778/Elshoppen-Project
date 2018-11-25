
function addComment(message, reply) {
    var product = $("#comment").attr("product");

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

$("#comment").keyup(function() {
    if ($(this).val().length == 0) {
        $("#comment-btn").attr("disabled", "disabled");
    } else {
        $("#comment-btn").removeAttr("disabled");
    }
});

$(".reply").keyup(function() {
    var replyBtn = $(this).attr("target");
    if ($(this).val().length == 0) {
        $("#" + replyBtn).attr("disabled", "disabled");
    } else {
        $("#" + replyBtn).removeAttr("disabled");
    }
});

$("#comment-btn").click(function() {
    var message = $("#comment").val();
    alert("Sending: " + message);
    addComment(message, 0);
    
});

$(".reply-btn").click(function() {
    var textarea = $(this).siblings("div").children("textarea");
    var message = textarea.val();
    var reply = $(this).attr("to");
    
    textarea.val("");
    alert("Sending: " + message + " to comment id= " + reply);
    addComment(message, reply);
});

$(".show-reply-btn").click(function() {
    $(this).hide();
    $(this).next("span").show();
    $("#"+$(this).attr("target")).toggle();
});

$(".hide-reply-btn").click(function() {
    $(this).hide();
    $(this).prev("span").show();
});

$(".cancel-reply-btn").click(function() {
    $("#"+$(this).attr("divref")).hide();
    $("#"+$(this).attr("target")).val("");
});

$(".toggle-btn").click(function() {
    $("#"+$(this).attr("target")).toggle();
});

$(".write-reply-div").each(function() {
    $(this).hide();
});

$(".reply-div").each(function() {
    $(this).hide();
});

$(".hide-reply-btn").each(function() {
    $(this).hide();
});