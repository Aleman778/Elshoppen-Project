$(document).ready(function() {
    fixHeader();
    fixFooter();
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
});
$(window).resize(fixFooter);
$("#navbarSupportedContent").resize(fixFooter);

function fixHeader() {
    var newWidth = $("#profile-drop").width() + 48;
    $("#profile-drop").width(newWidth);
}

function fixFooter() {
    var docHeight = $(window).height();
    var footerHeight = $('#footer').height();
    var footerTop = $('#footer').position().top + footerHeight;

    if (footerTop < docHeight)
        $('#footer').css('margin-top', 20 + (docHeight - footerTop) + 'px');
}