$(window).ready(fixWrapper);
$(window).resize(fixWrapper);

$(".list-group-item-action").click(function() {
    if ($(this).hasClass("collapsed")) {
        $(this).children(".collapse-icon").css("transform", "rotate(-90deg)");
    } else {
        $(this).children(".collapse-icon").css("transform", "rotate(0deg)");
    }
});

var active = $('.list-group-item[href="' + $("#sidebar").attr("url") + '"]')
if (active) {
    active.addClass("active");
    if (active.hasClass("sub-link")) {
        var target = active.parent().attr("id");
        var selector = $(".sidebar-link[href='#" + target + "']")
        selector.children(".collapse-icon").css("transform", "rotate(-90deg)");
        active.parent().collapse('show');
        active.children(".collapse-icon").css("transform", "rotate(-90deg)");
    }
}

function fixWrapper() {
    var height = $("body").height() - 48;
    $("#wrapper").height(height);
}