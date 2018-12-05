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
                border-top-right-radius: 0px;
                border-bottom-right-radius: 0px;
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
                cursor: inherit;
                display: block;
            }

            input[readonly] {
                background-color: white !important;
                cursor: text !important;
            }
        </style>
    </head>
    <body>
        <?php include("$root/admin/header.php"); ?>
        <div id="wrapper" class="row">
            <div id="sidebar-div" class="col-sm">
                <?php include("$root/admin/sidebar.php"); ?>
            </div>
            <div class="col-sm p-4">
                <h3>Lägg till produkter</h3>
                <h4>Produktinformation</h4>
                <form action="insert.php" method="POST">
                    <div class="form-group">
                        <label for="dbname">Produktnamn</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Skriv produktens namn">
                    </div>
                    <div class="form-group">
                        <label for="category">Kategori</label>
                        <input type="kategori" class="form-control" id="category" name="category" placeholder="Skriv kategorin">
                    </div>
                    <div class="form-group">
                        <label for="price">Pris</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Skriv lösenord">
                    </div>
                    <div class="form-group">
                        <label for="description">Kortfattad beskrivning av produkten</label>
                        <textarea class="form-control" id="description" name="description" rows="3" maxlength="1000"></textarea>
                    </div>
                    <h4>Produktbilder</h4>
                    <div class="form-group">
                        <label for="dbname">Produktens bildmapp</label>
                        <div class="row ml-4 mr-4">
                            <span style="padding-top: 7px;">/images/items/</span>
                            <div class="col-lg px-1">
                                <input type="text" class="form-control" id="imageFolder" name="imageFolder" placeholder="P">
                            </div>
                            <span style="padding-top: 7px;">/</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#uploadImage">
                            <img src="/images/icons/cloud_upload.svg" style="margin-top: -0.25em;" width=24 height=24>
                            <span>Ladda upp</span>
                        </a>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Lägg till</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="uploadImage" tabindex="-1" role="dialog" aria-labelledby="uploadImageModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadImageModal">Ladda upp bilder på produkten</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-primary btn-file">
                                    Browse&hellip; <input type="file" single>
                                </span>
                            </span>
                            <input type="text" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" type="button" class="btn btn-secondary" data-dismiss="modal">Avbryt</button>
                        <a href="#" type="button" class="btn btn-primary">Ladda upp</a>
                    </div>
                </div>
            </div>
        </div>

        <?php include("$root/modules/bootstrap_js.php"); ?>

        <!-- Run basic admin script -->
        <script src="/admin/basic.js"></script>

        <script>
            /* From: https://codepen.io/patrickt010/pen/WbKroW */
            $(document).on('change', '.btn-file :file', function() {
                var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [numFiles, label]);
            });

            $(document).ready( function() {
                $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
                    
                    var input = $(this).parents('.input-group').find(':text'),
                        log = numFiles > 1 ? numFiles + ' files selected' : label;
                    
                    if( input.length ) {
                        input.val(log);
                    } else {
                        if( log ) alert(log);
                    }
                });
            });
        </script>
    </body>
</html>
