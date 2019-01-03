<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/admin/access.php");
    include("$root/modules/mysql.php");
    $customer_id = $_GET["cid"];
    $db = new MySQL();
    $sql = "SELECT firstname, lastname , gender, 
            birth_date, email, phone_number, address 
            From CUSTOMERS WHERE id = $customer_id";
    $customer = $db->fetch($sql);
    $employee = $db->fetch("SELECT role FROM EMPLOYEES WHERE id=$customer_id;");
    if ($employee) {
        $customer["role"] = $employee["role"];
    } else {
        $customer["role"] = "Kund";
    }
  ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin - Ändra användaruppgifter</title>
        <?php include("$root/modules/bootstrap_css.php") ?>
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
                        if ($_GET["err"] == "fname_length")
                            $err_msg = "Förnamnet får maximalt vara 40 bokstäver långt.";
                        else if ($_GET["err"] == "fname_empty")
                            $err_msg = "Förnamnet får inte vara tomt.";
                        else if ($_GET["err"] == "lname_length")
                            $err_msg = "Efternamnet får maximalt vara 40 bokstäver långt.";
                        else if ($_GET["err"] == "lname_empty")
                            $err_msg = "Efternamnet får inte vara tomt.";
                        else if (array_key_exists("errmsg", $_GET))
                            $err_msg = $_GET["errmsg"];
                        if ($_GET["err"] == "pass_length")
                            $err_msg = "Lösenord måste vara 4 till 20 bokstäver långt.";
                        else if ($_GET["err"] == "pass_mismatch")
                            $err_msg = "Det upprepande lösenordet matchar inte.";
                        if ($err_msg != "") {
                            echo "<div class=\"alert alert-danger\" role=\"alert\">$err_msg</div>";
                        }

                        if ($err_msg != "") {
                            echo "<div class=\"alert alert-danger\" role=\"alert\">$err_msg</div>";
                            }
                        }
                ?>
                <form action="update.php?cid=<?php echo $customer_id;?>" method="post">
                    <h1>Ändra information</h1>
                    <p>Ändra den information som inte stämmer, klicka sedan spara.</p>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-md-2">
                            <label for="first-name"><b>Förnamn</b></label>
                        </div>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="<?php echo $customer["firstname"]; ?>" placeholder="Fyll i förnamn" name="first-name" maxlength="40" required>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-2">
                            <label for="last-name"><b>Efternamn</b></label>
                        </div>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="<?php echo $customer["lastname"]; ?>" placeholder="Fyll i efternamn" name="last-name" maxlength="40" required>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-2">
                            <label for="date-of-birth"><b>Födelsedatum</b></label>
                        </div>
                        <div class="col-md-10">
                            <input class="form-control" type="date" value="<?php echo $customer["birth_date"]; ?>" placeholder="Fyll i födelsedatum" name="bday" required>
                        </div>
                    </div>
                    <!-- change gender off -->
                    <!-- <div class="row mb-2">
                        <div class="col-md-2">
                            <label for="gender"><b>Kön</b></label>
                        </div>
                        <div class="col-md-5">
                            <?php
                                if($customer["gender"] == "m"){ ?>
                                    <input type="radio" name="gender" value="male"checked> Man
                                    <input type="radio" name="gender" value="female"> Kvinna
                                <?php
                                } else {
                                    ?>
                                    <input type="radio" name="gender" value="male"> Man
                                    <input type="radio" name="gender" value="female"checked> Kvinna
                                <?php
                                }

                            ?>
                        </div>
                    </div> -->
                    <div class="row mb-2">
                        <div class="col-md-2">
                            <label for="email"><b>Epost</b></label>
                        </div>
                        <div class="col-md-10">
                            <input class="form-control" type="email" value="<?php echo $customer["email"]; ?>" placeholder="Fyll i epost" name="email" required>
                        </div>
                    </div>
                    <br>
                        
                    <div class="row mb-2">
                        <div class="col-md-2">
                            <label for="mobile-number"><b>Mobilnummer</b></label>
                        </div>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="<?php echo $customer["phone_number"]; ?>" placeholder="Fyll i mobilnummer" maxlength="10" name="mobile-number">
                        </div>
                    </div>
                        
                    <div class="row mb-2">
                        <div class="col-md-2">
                            <label for="address"><b>Adress</b></label>
                        </div>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="<?php echo $customer["address"]; ?>" placeholder="Fyll i adress" name="address" >
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-2">
                            <label for="psw"><b>Nytt lösenord</b></label>
                        </div>
                        <div class="col-md-10">
                            <input class="form-control" type="password" placeholder="Fyll i nytt lösenord" maxlength="20" name="psw" >
                        </div>
                    </div>
                        
                    <div class="row mb-2">
                        <div class="col-md-2">
                            <label for="psw-repeat"><b>Repetera lösenord</b></label>
                        </div>
                        <div class="col-md-10">
                            <input class="form-control" type="password" placeholder="Repetera nytt lösenord" maxlength="20" name="psw-repeat" >
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-2">
                            <label for="role"><b>Roll</b></label>
                        </div>
                        <div class="col-md-10">
                            <select class="form-control" id="role" name="role">
                                <option <?php if ($customer["role"] == "Kund") { echo "selected"; } ?>>Kund</option>
                                <option <?php if ($customer["role"] == "Admin") { echo "selected"; } ?>>Admin</option>
                                <option <?php if ($customer["role"] == "Moderator") { echo "selected"; } ?>>Moderator</option>
                            </select>
                        </div>
                    </div>

                    <div class="clearfix mt-4">
                        <button type="submit" class="btn btn-primary">Spara</button>
                        <a href="/admin/users/list/" class="btn btn-secondary">Avbryt</a>
                        <hr>
                    </div>
                    
                </form>
            </div>
        </div>
        <?php include("$root/footer.php") ?>
        <?php include("$root/modules/bootstrap_js.php") ?>

        <!-- fix footer position -->
        <script src="/footer.js"></script>

        <!-- Run basic admin script -->
        <script src="/admin/basic.js"></script>
    </body>
</html> 