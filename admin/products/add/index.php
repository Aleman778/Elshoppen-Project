<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/admin/access.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin - Produkter</title>
        <?php include("$root/modules/bootstrap_css.php"); ?>
        <link rel="stylesheet" href="/admin/style.css">
        <style>
            /* From: https://codepen.io/patrickt010/pen/WbKroW  slightly modified to work with BS 4.1 */
            .btn-file {
                position: relative;
                overflow: hidden;
                cursor: pointer;
            }

            .btn-file input[type=file] {
                position: absolute;
                top: 0;
                right: 0;
                min-width: 100%;
                min-height: 100%;
                font-size: 100px;
                text-align: right;
                filter: alpha(opacity=0);
                opacity: 0;
                background: red;
                display: block;
                cursor: pointer;
            }

            .product-image {
                width: 10rem;
                height: 10rem;
                display:table-cell;
                text-align:center;
                border: solid 3px gray;
                border-radius: 6px;
                overflow: hidden;
                float: left;
                background-color: white;
            }

            .checked {
                border: solid 3px green;
            }

            .image-div {
                overflow: hidden;
                height: 10rem;
                width: 10rem;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            #imageResults {
                background-color: rgb(240, 240, 240);
                border-radius: 6px;
                min-height: 176px;
            }
        </style>
    </head>
    <body>
        <?php include("$root/admin/header.php"); ?>
        <div id="wrapper" class="row">
            <div id="sidebar-div" class="col-sm">
                <?php include("$root/admin/sidebar.php"); ?>
            </div>
            <div id="content-div" class="col-sm p-4">
                <?php if (array_key_exists("ins", $_GET)) { ?>
                    <?php if ($_GET["ins"] == "success") { ?>
                        <div class="alert alert-success" role="alert">
                            The product was successfully inserted into the database!
                        </div>
                    <?php } ?>
                    <?php if ($_GET["ins"] == "error") { ?>
                        <div class="alert alert-danger" role="alert">
                            The product failed to insert into the database! Error message:<br>
                            <?php echo $_GET["msg"]; ?>
                        </div>
                    <?php } ?>
                <?php } ?>
                <h3>Lägg till produkter</h3>
                <h4>Produktinformation</h4>
                <form action="insert.php" method="POST">
                    <div class="form-group">
                        <label for="dbname">Produktnamn</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Skriv produktens namn">
                    </div>
                    <div class="form-group">
                        <label for="category">Välj kategori</label>
                        <select class="form-control" id="category" name="category">
                            <option>Gaming</option>
                            <option>Tv och bild</option>
                            <option>Mobiltelefoner</option>
                            <option>Datorer</option>
                            <option>Vitvaror</option>
                            <option>Personvård</option>
                            <option>Foto och video</option>
                            <option>Smart hem</option>
                            <option>Wearables och träning</option>
                            <option>Ljud och hi-fi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Lagerstatus (antal)</label>
                        <input type="number" class="form-control" id="inventory" name="inventory" placeholder="Skriv in hur många det finns kvar i lagret">
                    </div>
                    <div class="form-group">
                        <label for="price">Pris (kronor)</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Skriv produktens pris">
                    </div>
                    <div class="form-group">
                        <label for="description">Beskrivning av produkten</label>
                        <textarea class="form-control" id="description" name="description" rows="3" maxlength="1000" placeholder="Skriv en kort beskrivning om produkten"></textarea>
                    </div>
                    <h4>Produktbilder</h4>
                    <div id="status"></div>
                    <div class="form-group">
                        <label for="dbname">Produktens bildmapp</label>
                        <div class="row ml-4 mr-4">
                            <span style="padding-top: 7px;">/images/items/</span>
                            <div class="col-lg px-1">
                                <input type="text" class="form-control" id="imageFolder" name="imageFolder" placeholder="produktens_namn">
                            </div>
                            <span style="padding-top: 7px;">/</span>
                        </div>
                    </div>
                    <h6 class="ml-4">Arrangera bilderna i den ordningen som önskas, den första bilden kommer användas som produktens omslagsbild.</h6>
                    <div class="ui-sortable form-group row ml-4 mr-4 pl-2 pr-2 pt-2 pb-0" id="imageResults"></div>
                    <div class="form-group ml-4">
                        <a href="#" class="btn btn-secondary btn-file">
                            <img src="/images/icons/cloud_upload.svg" style="margin-top: -0.25em;" width=24 height=24>
                            Ladda upp <input type="file" single>
                        </a>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Lägg till</button>
                    </div>
                </form>
            </div>
        </div>
        
        <?php include("$root/modules/bootstrap_js.php"); ?>
        
        <!-- jQuery UI -->
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

        <!-- Run basic admin script -->
        <script src="/admin/basic.js"></script>

        <script>
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

            $("#imageFolder").keyup(function() {
                $.ajax({
                    method: "GET",
                    url: "/admin/products/add/images.php",
                    data: {
                        dir: "images/items/" + $(this).val()
                    }
                }).done(function(html) {
                    $("#imageResults").html(html);
                });
            });
        </script>
    </body>
</html>
