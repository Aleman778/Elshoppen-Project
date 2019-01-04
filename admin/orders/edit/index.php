<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/admin/access.php");

    $editAccess = checkAccess("/admin/products/edit/index.php");
    $deleteAccess = checkAccess("/admin/products/list/delete.php");
    $oid = $_GET["oid"];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin - Beställningar</title>
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
                            The product in the order was successfully removed from the database!
                        </div>
                    <?php } ?>
                    <?php if ($_GET["del"] == "error") { ?>
                        <div class="alert alert-danger" role="alert">
                            The product in the order failed to be removed from the database! Error message:<br>
                            <?php echo $_GET["msg"]; ?>
                        </div>
                    <?php } ?>
                <?php } ?>
                <?php if (array_key_exists("edit", $_GET)) { ?>
                    <?php if ($_GET["edit"] == "success") { ?>
                        <div class="alert alert-success" role="alert">
                            The product in the order was successfully updated in the database!
                        </div>
                    <?php } ?>
                    <?php if ($_GET["edit"] == "error") { ?>
                        <div class="alert alert-danger" role="alert">
                            The product in the order failed to be updated in the database! Error message:<br>
                            <?php echo $_GET["msg"]; ?>
                        </div>
                    <?php } ?>
                <?php } ?>
                <h3>Produkter</h3>
                <button type="submit" onclick="window.location.href='/admin/orders/add/index.php?oid=<?php echo $oid; ?>'" class="btn btn-primary">Lägg till produkt</button>
                    
                <?php
                    include("$root/modules/mysql.php");
                    $db = new MySQL();
                    $sql = "SELECT * FROM ORDERS_PRODUCTS WHERE order_id=$oid";
                    $items = $db->fetchAll($sql);
                ?>
                <table class="table" style=" border-bottom: 1px solid #dee2e6;">
                    <thead class="thead">
                        <tr>
                            <th scope="col" style="border: none;">Order ID</th>
                            <th scope="col" style="border: none;">Produkt ID</th>
                            <th scope="col" style="border: none;">Antal</th>
                            <th scope="col" style="border: none;">Pris</th>
                            <?php if ($editAccess or $deleteAccess) { ?>
                                <th scope="col" style="border: none;">Åtgärder</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($items as $item) { ?>
                        
                        <tr>
                            <td style="text-align: center;" class="oid">
                                <?php echo $item["order_id"]; ?>
                            </td>
                            <td style="text-align: center;" class="pid">
                                <?php echo $item["product_id"]; ?>
                            </td>
                            <td style="text-align: center;" class="quantity">
                                <?php echo $item["quantity"]; ?>
                            </td>
                            <td style="text-align: center;" class="price">
                                <?php echo $item["price"] ?> 
                            </td>
                            <?php if ($editAccess or $deleteAccess) { ?>
                                <td>
                                    <?php if ($editAccess) { ?>
                                        <a href="/admin/orders/edit/edit.php?oid=<?php echo $item["order_id"]; ?>&pid=<?php echo $item["product_id"]; ?>" class="btn-edit"><img src="/images/icons/edit.svg"></a>
                                    <?php } ?>
                                    <?php if ($deleteAccess) { ?>
                                        <a href="#" class="btn-delete" data-toggle="modal" data-target="#deleteProduct<?php echo $item["product_id"]; ?>"><img src="/images/icons/delete.svg"></a> 
                                    <?php } ?>
                                </td>
                            <?php } ?>
                        </tr>
                        

                        <!-- Modal -->
                        <?php if ($deleteAccess) { ?>
                            <div class="modal fade" id="deleteProduct<?php echo $item["product_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteProductModal<?php echo $item["product_id"]; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteProductModal<?php echo $item["product_id"]; ?>">Är du säker på att du vill ta bort produkten?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md">
                                                    <h5 class="mb-1"><b>Produkt id: </b><?php echo $item["product_id"]; ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#" type="button" class="btn btn-secondary" data-dismiss="modal">Avbryt</button>
                                            <a href="delete.php?oid=<?php echo $item["order_id"]; ?>&pid=<?php echo $item["product_id"]; ?>" type="button" class="btn btn-danger">Radera</a>
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
