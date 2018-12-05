<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("access.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin - ELSHOPPEN</title>
        <?php include("$root/modules/bootstrap_css.php"); ?>
        <link rel="stylesheet" href="/admin/style.css">
    </head>
    <body>
        <?php include("header.php"); ?>
        <div id="wrapper" class="row">
            <div id="sidebar-div" class="col-sm">
                <?php include("sidebar.php"); ?>
            </div>
            <div class="col-sm p-4">
                <?php if (array_key_exists("err", $_GET)) { ?>
                    <?php if ($_GET["err"] == "permission") { ?>
                        <div class="alert alert-danger" role="alert">
                            Fel! Du har inte tillåtelse att gå till den förfrågade sidan.
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-danger" role="alert">
                            Något har gått fel!
                        </div>
                    <?php } ?>
                <?php } ?>
                <h3 class="mb-4">Dashboard</h3>
                <div class="row">
                    <div class="col-sm">
                        <div class="card text-white bg-primary">
                            <div class="card-body row">
                                <img src="/images/icons/comment.svg" width=50 height=50>
                                <div class="col-md" style="text-align: right;">
                                    <h3>25</h3>
                                    Nya kommentarer!
                                </div>
                            </div>
                            <a href="#" class="card-footer text-dark bg-light">
                                Visa detaljer
                                <img src="/images/icons/right.svg" width=18 height=18>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card text-white bg-success">
                            <div class="card-body row">
                                <img src="/images/icons/cart.svg" width=50 height=50>
                                <div class="col-md" style="text-align: right;">
                                    <h3>25</h3>
                                    Nya beställningar!
                                </div>
                            </div>
                            <a href="#" class="card-footer text-dark bg-light">
                                Visa detaljer
                                <img src="/images/icons/right.svg" width=18 height=18>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card text-white bg-warning">
                            <div class="card-body row">
                                <img src="/images/icons/star.svg" width=50 height=50>
                                <div class="col-md" style="text-align: right;">
                                    <h3>25</h3>
                                    Nya recensioner!
                                </div>
                            </div>
                            <a href="#" class="card-footer text-dark bg-light">
                                Visa detaljer
                                <img src="/images/icons/right.svg" width=18 height=18>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card text-white bg-danger">
                            <div class="card-body row">
                                <img src="/images/icons/people.svg" width=50 height=50>
                                <div class="col-md" style="text-align: right;">
                                    <h3>25</h3>
                                    Nya användare!
                                </div>
                            </div>
                            <a href="#" class="card-footer text-dark bg-light">
                                Visa detaljer
                                <img src="/images/icons/right.svg" width=18 height=18>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include("$root/modules/bootstrap_js.php"); ?>

        <!-- Run basic admin script -->
        <script src="/admin/basic.js"></script>
    </body>
</html>
