$("#review-msg").keyup(function() {
    if ($(this).val().length == 0) {
        $("#review-btn").attr("disabled", "disabled");
    } else {
        $("#review-btn").removeAttr("disabled");
    }
});

$("#review-btn").click(function() {
    var message = $("#review-msg").val();
    $("#review-msg").val("");
    $(this).attr("disabled", "disabled");
    addReview(message, 0, $("#reviews"));
});


function addReview(message, rat, selector) {
    var product = $("#review-btn").attr("product");

    $.ajax({
        method: "POST",
        url: "/modules/add_review.php",
        data: {
            product_id: product,
            rating: rat,
            review: message
        }
    }).done(function(html) {
        if (html == "Error!") {
            html = '<div class="alert alert-primary" role="alert">' +
                   '    Something went wrong when sending your review, please try again.' +
                   '</div>';
        }
        selector.prepend(html);
    });
}