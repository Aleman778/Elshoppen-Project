<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/admin/access.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin - MySQL databasanslutning</title>
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
                <h3>MySQL databasanslutning</h3>
                <?php 
                    if (array_key_exists("err", $_GET)) {
                        $msg = "No error message reported";
                        if (array_key_exists("msg", $_GET)) {
                            $msg = $_GET["msg"];
                        }
                        if ($_GET["err"] == "dbconn") {
                            echo("<div class=\"alert alert-danger\" role=\"alert\">Connection failed! Could not connect to the database. Error message:<br>$msg</div>");
                        }
                        if ($_GET["err"] == "other") {
                            echo("<div class=\"alert alert-danger\" role=\"alert\">$msg</div>");
                        }
                    }
                ?>
                <h4 class="mb-4">Nuvarande databasanslutningsuppgifter</h4>
                <p class="mb-0">Databas namn: db971229</p>
                <p class="mb-0">Användarnamn: 971229</p>
                <p>Databas värd: utbweb.its.ltu.se</p>

                <h4 class="mb-4">Nedan bör du ange databasanslutningsuppgifter</h4>
                <form action="connect.php" method="POST">
                    <div class="form-group">
                        <label for="dbname">Databas namn</label>
                        <input type="text" class="form-control" id="dbname" name="dbname" placeholder="Skriv databas namn">
                    </div>
                    <div class="form-group">
                        <label for="dbuser">Användarnamn</label>
                        <input type="text" class="form-control" id="dbuser" name="dbuser" placeholder="Skriv användarnamn">
                    </div>
                    <div class="form-group">
                        <label for="dbpass">Lösenord</label>
                        <input type="password" class="form-control" id="dbpass" name="dbpass" placeholder="Skriv lösenord">
                    </div>
                    <div class="form-group">
                        <label for="dbhost">Databas värd</label>
                        <input type="text" class="form-control" id="dbhost" name="dbhost" placeholder="Skriv databas värd">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

        <?php include("$root/modules/bootstrap_js.php"); ?>

        <!-- Run basic admin script -->
        <script src="/admin/basic.js"></script>
    </body>
</html>
