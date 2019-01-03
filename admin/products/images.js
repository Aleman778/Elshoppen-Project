$(document).on("change", ".btn-file :file", function() {
    var file = $(this).val().replace(/\\/g, '/').replace(/.*\//, '');
    var file_data = $(this).prop('files')[0];   
    var folder_data = $("#imageFolder").val();
    if (folder_data == "") {
        $("#status").html('<div class="alert alert-danger" role="alert">Please specify a folder to store the image in.</div>');
        return;
    }
    var form_data = new FormData();                  
    form_data.append('file', file_data);
    form_data.append('folder', folder_data);
    $.ajax({
        url: '/admin/products/add/upload.php', // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(html) {
            if (html.indexOf("product-image") > 0) {
                $("#imageResults").append(html);
                $("#status").html('<div class="alert alert-success" role="alert">Image was successfully uploaded!</div>');
            } else {
                $("#status").html('<div class="alert alert-danger" role="alert">' + html + '</div>');
            }
        }
    });
});

$(document).on("click", ".product-image", function(evt) {
    var $checkbox = $(this).children("input[type=checkbox]");
    if ($checkbox.attr("checked")) {
        $(this).children(".checked-icon").hide();
        $(this).removeClass("checked");
        $checkbox.removeAttr("checked");
    } else {
        $(this).children(".checked-icon").show();
        $(this).addClass("checked");
        $checkbox.attr("checked", "");
    }
    evt.stopPropagation();
    evt.preventDefault();
});

$("#imageResults").sortable({scroll: false});
$("#imageResults").disableSelection();

var $imageFolder = $("#imageFolder");
$imageFolder.keyup(updateImages);

function updateImages() {
    $.ajax({
        method: "GET",
        url: "/admin/products/add/images.php",
        data: {
            dir: "images/items/" + $imageFolder.val()
        }
    }).done(function(html) {
        $("#imageResults").html(html);
    });
}