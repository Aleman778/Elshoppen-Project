$(document).ready(fixFooter);
$(window).resize(fixFooter);
$("#navbarSupportedContent").resize(fixFooter);


function fixFooter() {
    var docHeight = $(window).height();
    var footerHeight = $('#footer').height();
    var footerTop = $('#footer').position().top + footerHeight;

    if (footerTop < docHeight)
        $('#footer').css('margin-top', 20 + (docHeight - footerTop) + 'px');
}