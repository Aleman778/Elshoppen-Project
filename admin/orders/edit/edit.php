<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/admin/access.php");
    include("$root/modules/mysql.php");
    
    $oid = $_GET["oid"];
    $pid = $_GET["pid"];
    
    $db = new MySQL();
    $item = $db->fetch("SELECT * FROM ORDERS_PRODUCTS WHERE order_id=$oid AND product_id=$pid");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin - Produkt</title>
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
                            The product was successfully updated!
                        </div>
                    <?php } ?>
                    <?php if ($_GET["ins"] == "error") { ?>
                        <div class="alert alert-danger" role="alert">
                            The product failed to update! Error message:<br>
                            <?php echo $_GET["msg"]; ?>
                        </div>
                    <?php } ?>
                <?php } ?>
                <h3>Uppdatera produkt</h3>
                <form action="update.php?pid=<?php echo $pid; ?>&oid=<?php echo $oid; ?>" method="POST">
                    <div class="form-group">
                    <p><b>Antal</b></p>
                    <input type="number"  name="quantity" min="1" max="50" step="1" value=<?php echo $item["quantity"]; ?> />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Updatera</button>
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
