<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/admin/access.php");
    include("$root/modules/mysql.php");
    $pid = $_GET["pid"];
    $db = new MySQL();
    $sql = "SELECT name, price, inventory, image_ref, category, description From PRODUCTS WHERE id = $pid";
    $product =  $db->fetch($sql);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin - Uppdatera Produkt</title>
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
                <h3>Uppdatera produkt</h3>
                <h4>Produktinformation</h4>
                <form action="update.php?pid=<?php echo $pid;?>" method="POST">
                    <div class="form-group">
                        <label for="dbname">Produktnamn</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Skriv produktens namn" value="<?php echo $product["name"] ?>">
                    </div>
                    <div class="form-group">
                        <label for="category">Välj kategori</label>
                        <select class="form-control" id="category" name="category" value="<?php echo $product["category"]?>">
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
                        <input type="number" class="form-control" id="inventory" name="inventory" 
                                placeholder="Skriv in hur många det finns kvar i lagret" value="<?php echo $product["inventory"]?>">
                    </div>
                    <div class="form-group">
                        <label for="price">Pris (kronor)</label>
                        <input type="number" class="form-control" id="price" name="price" 
                                placeholder="Skriv produktens pris" value="<?php echo $product["price"]?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Beskrivning av produkten</label>
                        <textarea class="form-control" id="description" name="description" rows="3" maxlength="1000" 
                                    placeholder="Skriv en kort beskrivning om produkten" ><?php echo $product["description"]?></textarea>
                    </div>
                    <h4>Produktbilder</h4>
                    <?php $images = explode(",", $product["image_ref"]); ?>
                    <div class="form-group">
                        <label for="dbname">Produktens bildmapp</label>
                        <div class="row ml-4 mr-4">
                            <span style="padding-top: 7px;">/images/items/</span>
                            <div class="col-lg px-1">
                                <input type="text" class="form-control" id="imageFolder" name="imageFolder" 
                                        placeholder="produktens_namn" value="<?php echo $images[0]; ?>">
                            </div>
                            <span style="padding-top: 7px;">/</span>
                        </div>
                    </div>
                    <h6 class="ml-4">Arrangera bilderna i den ordningen som önskas, den första bilden kommer användas som produktens omslagsbild.</h6>
                    <div class="ui-sortable form-group row ml-4 mr-4 pl-2 pt-2 pb-0" id="imageResults">
                        <?php for($i = 1; $i < count($images); $i++) { ?>
                            <div class="form-group form-check product-image p-0 mb-2 mr-2 checked" style="position: relative; top: 0; left: 0;">
                                <div class="checked-icon" style="position: absolute; top: -3px; left: -2px; background-color: green; width: 28px; height: 30px; border-bottom-right-radius: 6px;">
                                    <img src="/images/icons/done.svg">
                                </div>
                                <input type="checkbox" checked id="image-<?php echo $images[$i]; ?>" name="image-<?php echo $images[$i]; ?>" hidden>
                                <input type="text" value="<?php echo $images[$i]; ?>" name="file-<?php echo $images[$i]; ?>" hidden>
                                <label class="from-check-label mb-0" for="image-<?php echo $images[$i]; ?>">
                                    <div class="image-div">
                                        <img style="height: 10rem; display: block; margin: 0 auto;" src="/images/items/<?php echo $images[0] . "/" . $images[$i]; ?>" alt="Image not found">
                                    </div>
                                </label>
                            </div>
                        <?php } ?>
                        <?php $folder_images = glob("../../../images/items/" . $images[0] . "/*.{jpg,jpeg,png,gif}", GLOB_BRACE); ?>
                        <?php 
                            $other_images = [];
                            foreach ($folder_images as $image) {
                                $parts = explode("/", $image);
                                if (!in_array($parts[count($parts) - 1], $images)) {
                                    array_push($other_images, $parts[count($parts) - 1]);
                                }
                            } 
                        ?>
                        <?php for($i = 0; $i < count($other_images); $i++) { ?>
                            <div class="form-group form-check product-image p-0 mb-2 mr-2" style="position: relative; top: 0; left: 0;">
                                <div class="checked-icon" style="display: none; position: absolute; top: -3px; left: -2px; background-color: green; width: 28px; height: 30px; border-bottom-right-radius: 6px;">
                                    <img src="/images/icons/done.svg">
                                </div>
                                <input type="checkbox" id="image-<?php echo $other_images[$i]; ?>" name="image-<?php echo $other_images[$i]; ?>" hidden>
                                <input type="text" value="<?php echo $other_images[$i]; ?>" name="file-<?php echo $other_images[$i]; ?>" hidden>
                                <label class="from-check-label mb-0" for="image-<?php echo $images[$i]; ?>">
                                    <div class="image-div">
                                        <img style="height: 10rem; display: block; margin: 0 auto;" src="/images/items/<?php echo $images[0] . "/" . $other_images[$i]; ?>" alt="Image not found">
                                    </div>
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group ml-4">
                        <a href="#" class="btn btn-secondary btn-file">
                            <img src="/images/icons/cloud_upload.svg" style="margin-top: -0.25em;" width=24 height=24>
                            Ladda upp <input type="file" single>
                        </a>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Uppdatera</button>
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
