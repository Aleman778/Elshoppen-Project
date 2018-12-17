<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/admin/access.php");

    $editAccess = checkAccess("/admin/products/edit/index.php");
    $deleteAccess = checkAccess("/admin/products/list/delete.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin - Produkter</title>
        <?php include("$root/modules/bootstrap_css.php"); ?>
        <link rel="stylesheet" href="/admin/style.css">
    </head>
    <body>
        <?php include("$root/admin/header.php"); ?>
        <div id="wrapper" class="row">
            <div id="sidebar-div" class="col-sm">
                <?php include("$root/admin/sidebar.php"); ?>
            </div>
            <div id="content-div" class="col-sm p-4">
                <?php if (array_key_exists("del", $_GET)) { ?>
                    <?php if ($_GET["del"] == "success") { ?>
                        <div class="alert alert-success" role="alert">
                            The product was successfully removed from the database!
                        </div>
                    <?php } ?>
                    <?php if ($_GET["del"] == "error") { ?>
                        <div class="alert alert-danger" role="alert">
                            The product failed to be removed from the database! Error message:<br>
                            <?php echo $_GET["msg"]; ?>
                        </div>
                    <?php } ?>
                <?php } ?>
                <?php if (array_key_exists("edit", $_GET)) { ?>
                    <?php if ($_GET["edit"] == "success") { ?>
                        <div class="alert alert-success" role="alert">
                            The product was successfully updated in the database!
                        </div>
                    <?php } ?>
                    <?php if ($_GET["edit"] == "error") { ?>
                        <div class="alert alert-danger" role="alert">
                            The product failed to be updated in the database! Error message:<br>
                            <?php echo $_GET["msg"]; ?>
                        </div>
                    <?php } ?>
                <?php } ?>
                <h3>Produkter</h3>
                <?php
                    include("$root/modules/mysql.php");
                    $db = new MySQL();
                    $items = $db->fetchAll("SELECT * FROM PRODUCTS ORDER BY id DESC");
                ?>
                <table class="table" style=" border-bottom: 1px solid #dee2e6;">
                    <thead class="thead">
                        <tr>
                            <th scope="col" style="border: none;">Produkt</th>
                            <th scope="col" style="border: none;">Lagerstatus</th>
                            <th scope="col" style="border: none;">Styckpris</th>
                            <?php if ($editAccess or $deleteAccess) { ?>
                                <th scope="col" style="border: none;">Åtgärder</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($items as $item) { ?>
                        <?php
                            $images = explode(",", $item["image_ref"]);
                        ?>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-sm" style="max-width: 12rem; height: 8rem; overflow: hidden; text-align:center">
                                        <img src="<?php echo "/images/items/$images[0]/$images[1]"; ?>" style="height: 8rem;">
                                    </div>
                                    <div class="col-md">
                                        <h5 class="mb-1"><?php echo $item["name"]; ?></h5>
                                        <p><?php echo $item["description"] ?></p>
                                    </div>
                                </div>
                            </td>
                            <td style="text-align: center;" class="price">
                                <?php echo $item["inventory"] ?> st. kvar
                            </td>
                            <td style="text-align: center;" class="price">
                                <?php echo $item["price"] ?> kr
                            </td>
                            <?php if ($editAccess or $deleteAccess) { ?>
                                <td>
                                    <?php if ($editAccess) { ?>
                                        <a href="/admin/products/edit/index.php?pid=<?php echo $item["id"]; ?>" class="btn-edit"><img src="/images/icons/edit.svg"></a>
                                    <?php } ?>
                                    <?php if ($deleteAccess) { ?>
                                        <a href="#" class="btn-delete" data-toggle="modal" data-target="#deleteProduct<?php echo $item["id"]; ?>"><img src="/images/icons/delete.svg"></a> 
                                    <?php } ?>
                                </td>
                            <?php } ?>
                        </tr>
                        

                        <!-- Modal -->
                        <?php if ($deleteAccess) { ?>
                            <div class="modal fade" id="deleteProduct<?php echo $item["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteProductModal<?php echo $item["id"]; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteProductModal<?php echo $item["id"]; ?>">Är du säker på att du vill radera produkten?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm" style="max-width: 12rem; height: 8rem; overflow: hidden; text-align:center">
                                                    <img src="<?php echo "/images/items/$images[0]/$images[1]"; ?>" style="height: 8rem;">
                                                </div>
                                                <div class="col-md">
                                                    <h5 class="mb-1"><?php echo $item["name"]; ?></h5>
                                                    <p><?php echo $item["description"] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#" type="button" class="btn btn-secondary" data-dismiss="modal">Avbryt</button>
                                            <a href="delete.php?id=<?php echo $item["id"]; ?>" type="button" class="btn btn-danger">Radera</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </table>
                
            </div>
        </div>

        <?php include("$root/modules/bootstrap_js.php"); ?>

        <!-- Run basic admin script -->
        <script src="/admin/basic.js"></script>
    </body>
</html>
