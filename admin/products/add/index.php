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
        <link rel="stylesheet" href="/admin/products/style.css">
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
                    <div class="ui-sortable form-group row ml-4 mr-4 pl-2 pt-2 pb-0" id="imageResults"></div>
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

        <script src="/admin/products/images.js"></script>
    </body>
</html>
