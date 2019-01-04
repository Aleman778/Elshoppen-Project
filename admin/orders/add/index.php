<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/admin/access.php");
    include("$root/modules/mysql.php");
    
    $oid = $_GET["oid"];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin - Lägg till Produkt i order</title>
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
                            The product was successfully inserted!
                        </div>
                    <?php } ?>
                    <?php if ($_GET["ins"] == "error") { ?>
                        <div class="alert alert-danger" role="alert">
                            The product failed to insert! Error message:<br>
                            <?php echo $_GET["msg"]; ?>
                        </div>
                    <?php } ?>
                <?php } ?>
                <h3>Lägg till Produkt i order</h3>
                <form action="insert.php?oid=<?php echo $oid; ?>" method="POST">
                    <div class="form-group">
                        <p><b>Produkt id</b></p>
                        <input type="number"  name="pid" min="1" step="1"  />
                    </div>
                    <div class="form-group">
                        <p><b>Antal</b></p>
                        <input type="number"  name="quantity" min="1" max="50" step="1" />
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
