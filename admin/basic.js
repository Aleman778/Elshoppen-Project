$(window).ready(fixWrapper);
$(window).resize(fixWrapper);

$(".list-group-item-action").click(function() {
    if ($(this).hasClass("collapsed")) {
        $(this).children(".collapse-icon").show();
        $(this).children(".expanded-icon").hide();
    } else {
        $(this).children(".collapse-icon").show();
        $(this).children(".expanded-icon").hide();
    }
});

var active = $('.list-group-item[href="' + $("#sidebar").attr("url") + '"]')
if (active) {
    active.addClass("active");
    if (active.hasClass("sub-link")) 
        active.parent().collapse('show');
}

function fixWrapper() {
    var height = $("body").height() - 48;
    $("#wrapper").height(height);
}