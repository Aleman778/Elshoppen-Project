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
    </head>
    <body>
        <?php include("$root/admin/header.php"); ?>
        
        <div id="wrapper" class="row">
            <div id="sidebar-div" class="col-sm">
                <?php include("$root/admin/sidebar.php"); ?>
            </div>
            <div id="content-div" class="col-sm p-4">
                <?php 
                    if (array_key_exists("err", $_GET)) {
                        $err_msg = "";
                        if ($_GET["err"] == "pass_length")
                            $err_msg = "Lösenord måste vara 4 till 20 bokstäver långt.";
                        else if ($_GET["err"] == "fname_length")
                            $err_msg = "Förnamnet får maximalt vara 40 bokstäver långt.";
                        else if ($_GET["err"] == "fname_empty")
                            $err_msg = "Förnamnet får inte vara tomt.";
                        else if ($_GET["err"] == "lname_length")
                            $err_msg = "Efternamnet får maximalt vara 40 bokstäver långt.";
                        else if ($_GET["err"] == "lname_empty")
                            $err_msg = "Efternamnet får inte vara tomt.";
                        else if ($_GET["err"] == "pass_mismatch")
                            $err_msg = "Det upprepande lösenordet matchar inte.";
                        else if (array_key_exists("errmsg", $_GET))
                            $err_msg = $_GET["errmsg"];

                        if ($err_msg != "") {
                            echo "<div class=\"alert alert-danger\" role=\"alert\">$err_msg</div>";
                        }
                    }
                ?>
                <form action="insert.php" method="post">
                <h1>Skapa ett konto</h1>
                <p>Fyll i rutorna nedan för att skapa ett konto.</p>
                <hr>
                <div class="row mb-2">
                    <div class="col-md-2">
                        <label for="first-name"><b>Förnamn</b></label>
                    </div>
                    <div class="col-md-5">
                        <input class="form-control" type="text" placeholder="Fyll i förnamn" name="first-name" maxlength="40" required>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-2">
                        <label for="last-name"><b>Efternamn</b></label>
                    </div>
                    <div class="col-md-5">
                        <input class="form-control" type="text" placeholder="Fyll i efternamn" name="last-name" maxlength="40" required>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-2">
                        <label for="date-of-birth"><b>Födelsedatum</b></label>
                    </div>
                    <div class="col-md-5">
                        <input class="form-control" type="date" placeholder="Fyll i födelsedatum" name="bday" required>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-2">
                        <label for="gender"><b>Kön</b></label>
                    </div>
                    <div class="col-md-5">
                        <input type="radio" name="gender" value="male"> Man
                        <input type="radio" name="gender" value="female"> Kvinna
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-2">
                        <label for="email"><b>Epost</b></label>
                    </div>
                    <div class="col-md-5">
                        <input class="form-control" type="email" placeholder="Fyll i epost" name="email" required>
                    </div>
                </div>
                <br>

                <div class="row mb-2">
                    <div class="col-md-2">
                        <label for="psw"><b>Lösenord</b></label>
                    </div>
                    <div class="col-md-5">
                        <input class="form-control" type="password" placeholder="Fyll i lösenord" maxlength="20" name="psw" required>
                    </div>
                </div>
                    
                <div class="row mb-2">
                    <div class="col-md-2">
                        <label for="psw-repeat"><b>Repetera lösenord</b></label>
                    </div>
                    <div class="col-md-5">
                        <input class="form-control" type="password" placeholder="Repetera lösenord" maxlength="20" name="psw-repeat" required>
                    </div>
                </div>
                <br>
                    
                <div class="row mb-2">
                    <div class="col-md-2">
                        <label for="mobile-number"><b>Mobilnummer</b></label>
                    </div>
                    <div class="col-md-5">
                        <input class="form-control" type="text" placeholder="Fyll i mobilnummer" maxlength="10" name="mobile-number">
                    </div>
                </div>
                    
                <div class="row">
                    <div class="col-md-2">
                        <label for="address"><b>Adress</b></label>
                    </div>
                    <div class="col-md-5">
                        <input class="form-control" type="text" placeholder="Fyll i adress" name="address">
                    </div>
                </div>
                
                <div class="row mb-2">
                    <div class="col-md-2">
                            <label for="role"><b>Roll</b></label>
                    </div>
                    <div class="col-md-5">
                            <input type="radio" name="role" value="None"> None
                            <input type="radio" name="role" value="Admin"> Admin
                            <input type="radio" name="role" value="Moderator"> Moderator
                    </div>
                </div>

                <div class="clearfix mt-4">
                    <button type="submit" class="btn btn-primary">Skapa</button>
                    <a href="/admin" class="btn btn-secondary">Avbryt</a>
                    <hr>
                </div>
                </form> 
            </div>
        </div>
        

        <?php include("$root/modules/bootstrap_js.php"); ?>

        <!-- Run basic admin script -->
        <script src="/admin/basic.js"></script>

    </body>
</html>
