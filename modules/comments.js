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
    var product = $("#comment").attr("product");
    var msg = $("#comment").val();
    alert("Test");
    $.ajax({
        method: "POST",
        url: "/modules/add_comment.php",
        data: {
            product_id: product,
            reply_id: 0,
            comment: msg
        }
    }).done(function(msg) {
        alert(msg);
    });
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