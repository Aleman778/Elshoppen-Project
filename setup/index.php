<!DOCTYPE html>
<!-- Setup database and populate it with data! REMOVE THIS FROM RELEASE -->

<html>
<head>
    <meta charset="UTF-8">
    <?php include("../modules/bootstrap_css.php"); ?>
    <link rel="stylesheet" href="../checkbox.css">
    <style>
        #main-form {
            width: 50%;
            margin-top: 200px;
            min-width: 300px;
            background-color: white;
            box-shadow: 0px 0px 10px rgb(200, 200, 200);
        }
    </style>
</head>
<body style="background-color: rgb(230, 230, 230);">
    <div class="container py-3 rounded" id="main-form">
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
        <form action="setup.php" method="POST">
            <p class="mb-4">Below you should enter you database connection details.</p>
            <div class="form-group">
                <label for="dbname">Database Name</label>
                <input type="text" class="form-control" id="dbname" name="dbname" placeholder="Enter database name">
            </div>
            <div class="form-group">
                <label for="dbuser">Username</label>
                <input type="text" class="form-control" id="dbuser" name="dbuser" placeholder="Enter username">
            </div>
            <div class="form-group">
                <label for="dbpass">Password</label>
                <input type="password" class="form-control" id="dbpass" name="dbpass" placeholder="Enter password">
            </div>
            <div class="form-group">
                <label for="dbhost">Database Host</label>
                <input type="text" class="form-control" id="dbhost" name="dbhost" placeholder="Enter database host">
            </div>
            <div class="dropdown-divider"></div>
            <p>Select which tables to create. Duplicate tables are not created.</p>
            <div class="checkbox">
            <div class="form-group">
                <label class="customcheck">CART
                    <input type="checkbox" checked="checked" id="createCart" name="createCart">
                    <span class="checkmark"></span>
                </label>
                <label class="customcheck">COMMENT
                    <input type="checkbox" checked="checked" id="createComment" name="createComment">
                    <span class="checkmark"></span>
                </label>
                <label class="customcheck">CUSTOMER
                    <input type="checkbox" checked="checked" id="createCustomer" name="createCustomer">
                    <span class="checkmark"></span>
                </label>
                <label class="customcheck">ORDERS_PRODUCTS
                    <input type="checkbox" checked="checked" id="createProducts" name="createProducts">
                    <span class="checkmark"></span>
                </label>
                <label class="customcheck">ORDERS
                    <input type="checkbox" checked="checked" id="createOrders" name="createOrders">
                    <span class="checkmark"></span>
                </label>
                <label class="customcheck">REVIEWS
                    <input type="checkbox" checked="checked" id="createReviews" name="createReviews">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="dropdown-divider"></div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>



    <?php include("../modules/bootstrap_js.php"); ?>
</body>
</html>