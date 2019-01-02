<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/admin/access.php");
    include("$root/modules/mysql.php");

    $deleteAccess = checkAccess("/admin/comments/list/delete.php");
    
    $filter = "";

    if (array_key_exists("filter", $_GET)) {
        $filter = $_GET["filter"];
    }

    $db = new MySQL();
    $sql = "SELECT COMMENTS.*, CUSTOMERS.firstname, CUSTOMERS.lastname, CUSTOMERS.email, PRODUCTS.name
            FROM CUSTOMERS JOIN COMMENTS JOIN PRODUCTS
            WHERE CUSTOMERS.id=COMMENTS.customer_id AND PRODUCTS.id=COMMENTS.product_id";
    if ($filter != "") {
        $user = "";
        $product = "";
        $reply = "";
        $search = $filter;

        //Select user filter
        $startptr = strpos($filter, "{user:");
        $endptr = strpos($filter, "}");
        if ($startptr !== false and $endptr !== false) {
            $user = substr($filter, $startptr + 6, $endptr - $startptr - 6);
            $search = str_replace("{user:" . $user . "}", "", $search);
            $sql .= " AND CUSTOMERS.id='$user'";
        }
        
        //Select product filter
        $startptr = strpos($filter, "{product:");
        $endptr = strpos($filter, "}");
        if ($startptr !== false and $endptr !== false) {
            $product = substr($filter, $startptr + 9, $endptr - $startptr - 9);
            $search = str_replace("{product:" . $product . "}", "", $search);
            $sql .= " AND PRODUCTS.id='$product'";
        }
        
        //Select reply filter filter
        $startptr = strpos($filter, "{reply:");
        $endptr = strpos($filter, "}");
        if ($startptr !== false and $endptr !== false) {
            $reply = substr($filter, $startptr + 7, $endptr - $startptr - 7);
            $search = str_replace("{reply:" . $reply . "}", "", $search);
            $sql .= " AND COMMENTS.reply_id='$reply'";
        }

        //Search for specific word in comment
        $search = trim($search);
        if ($search != "") {
            $sql .= " AND COMMENTS.comment LIKE '%$search%'";
        }
    }
    $sql .= " ORDER BY id DESC";
    $comments = $db->fetchAll($sql);
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
                            The comment was successfully removed from the database!
                        </div>
                    <?php } ?>
                    <?php if ($_GET["del"] == "error") { ?>
                        <div class="alert alert-danger" role="alert">
                            The product failed to be removed from the database! Error message:<br>
                            <?php echo $_GET["msg"]; ?>
                        </div>
                    <?php } ?>
                <?php } ?>
                <h3>Kommentarer (<?php echo count($comments); ?>)</h3>
                <form autocomplete="off" action="index.php" method="GET">
                    <div class="form-group" style="position: relative; left: 0; top: 0;">
                        <label for="filter">Filtrera kommentarer</label>
                        <input type="text" class="form-control" id="filter" name="filter" placeholder="Sök bland kommentarerna" value="<?php echo $filter; ?>">
                        <ul id="autocomplete" class="list-group" style="position: absolute; left: 0; top: 70px; z-index: 1000;">
                            <!--<li class="autocomplete-option list-group-item list-group-item-action d-flex justify-content-between align-items-center" style="cursor: pointer;">
                                Alexander Mennborg
                                <span class="badge badge-primary badge-pill ml-3">användare</span>
                            </li>
                            <li class="autocomplete-option list-group-item list-group-item-action d-flex justify-content-between align-items-center" style="cursor: pointer;">
                                Nintendo Switch
                                <span class="badge badge-success badge-pill ml-3">produkt</span>
                            </li>-->
                        </ul>
                    </div>
                </form>
                <table class="table" style=" border-bottom: 1px solid #dee2e6;">
                    <thead class="thead">
                        <tr>
                            <th scope="col" style="border: none;">Kommentar</th>
                            <?php if ($deleteAccess) { ?>
                                <th scope="col" style="border: none;"></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($comments as $comment) { ?>
                            <tr>
                                <td>
                                    <div class="row">
                                        <img src="<?php echo get_gravatar($comment["email"], 38); ?>" class="rounded-circle m-2" width="38" height="38" style="margin-top:5px;">
                                        <div class="col-lg">
                                            <span class="badge badge-light"><?php echo $comment["id"]; ?></span>
                                            <a href="index.php?filter={user:<?php echo $comment["customer_id"]; ?>}" class="badge badge-primary"><?php echo $comment["firstname"] . " " . $comment["lastname"]; ?></a>
                                            <a href="index.php?filter={product:<?php echo $comment["product_id"]; ?>}" class="badge badge-success"><?php echo $comment["name"]; ?></a>
                                            <?php if ($comment["reply_id"] > 0) { ?>
                                                <a href="index.php?filter={reply:<?php echo $comment["reply_id"]; ?>}"  class="badge badge-danger">reply to comment <?php echo $comment["reply_id"]; ?></a>   
                                            <?php } ?>
                                            <span class="badge badge-secondary"><?php echo  "  " . $comment["time"];?></span>
                                            <p class="mb-1"><?php echo $comment["comment"]; ?></p>
                                        </div>
                                    </div>
                                </td>
                                <?php if ($deleteAccess) { ?>
                                    <td>
                                        <a href="#" class="btn-delete" data-toggle="modal" data-target="#deleteProduct<?php echo $comment["id"]; ?>"><img src="/images/icons/delete.svg"></a> 
                                    </td>
                                <?php } ?>
                            </tr>
                            

                            <!-- Modal -->
                            <?php if ($deleteAccess) { ?>
                                <div class="modal fade" id="deleteProduct<?php echo $comment["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteProductModal<?php echo $item["id"]; ?>" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteProductModal<?php echo $comment["id"]; ?>">Är du säker på att du vill radera kommentaren?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <img src="<?php echo get_gravatar($comment["email"], 38); ?>" class="rounded-circle m-2" width="38" height="38" style="margin-top:5px;">
                                                    <div class="col-lg">
                                                        <span class="badge badge-light"><?php echo $comment["id"]; ?></span>
                                                        <span class="badge badge-primary"><?php echo $comment["firstname"] . " " . $comment["lastname"]; ?></span>
                                                        <span class="badge badge-success"><?php echo $comment["name"]; ?></span>
                                                        <?php if ($comment["reply_id"] > 0) { ?>
                                                            <span class="badge badge-danger">reply to comment <?php echo $comment["reply_id"]; ?></span>   
                                                        <?php } ?>
                                                        <span class="badge badge-secondary"><?php echo  "  " . $comment["time"];?></span>
                                                        <p class="mb-1"><?php echo $comment["comment"]; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="#" type="button" class="btn btn-secondary" data-dismiss="modal">Avbryt</button>
                                                <a href="delete.php?id=<?php echo $comment["id"]; ?>" type="button" class="btn btn-danger">Radera</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php include("$root/modules/bootstrap_js.php"); ?>

        <!-- Run basic admin script -->
        <script src="/admin/basic.js"></script>
                                
        <!-- Autocomplete script -->
        <script type="text/javascript">
            <?php
                $products = $db->fetchAll("SELECT name FROM PRODUCTS ORDER BY removed, id DESC");
                $users    = $db->fetchAll("SELECT firstname, lastname, email FROM CUSTOMERS ORDER BY removed, id DESC");
                $jsProducts = json_encode($products);
                $jsUsers    = json_encode($users);
                echo "var products = $jsProducts;\n";
                echo "var users    = $jsUsers;\n";
            ?>
            var input = $("#filter");
            var selector = $("#autocomplete");

            function autocomplete(data) {
                
            }

            input.keyup(function(e) {
                autocomplete($(this).val());
            });

        </script>
    </body>
</html>
