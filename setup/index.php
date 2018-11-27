<!DOCTYPE html>
<!-- Setup database and populate it with data! REMOVE THIS FROM RELEASE -->

<html>
<head>
    <meta charset="UTF-8">
    <?php include("../modules/bootstrap_css.php"); ?>
    <link rel="stylesheet" href="../checkbox.css">
    <style>
        #main-form {
            margin-top: 200px;
            max-width: 700px;
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
                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="createCart">
                    <label class="custom-control-label" for="createCart">CART</label>
                </div>
                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="createComment">
                    <label class="custom-control-label" for="createComment">COMMENT</label>
                </div>
                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="createCustomer">
                    <label class="custom-control-label" for="createCustomer">CUSTOMER</label>
                </div>
                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="createOrdersProducts">
                    <label class="custom-control-label" for="createOrdersProducts">ORDERS_PRODUCTS</label>
                </div>
                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="createOrders">
                    <label class="custom-control-label" for="createOrders">ORDERS</label>
                </div>
                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="createReviews">
                    <label class="custom-control-label" for="createReviews">REVIEWS</label>
                </div>
                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="createEmployees">
                    <label class="custom-control-label" for="createEmployees">EMPLOYEES</label>
                </div>
            </div>
            <div class="dropdown-divider"></div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>



    <?php include("../modules/bootstrap_js.php"); ?>
</body>
</html>