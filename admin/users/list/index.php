<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/admin/access.php");

    $editAccess = checkAccess("/admin/products/list/edit.php");
    $deleteAccess = checkAccess("/admin/products/list/delete.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin - Users</title>
        <?php include("$root/modules/bootstrap_css.php"); ?>
        <link rel="stylesheet" href="/admin/style.css">
    </head>
    <body>
        <?php include("$root/admin/header.php"); ?>
        <div id="wrapper" class="row">
            <div id="sidebar-div" class="col-sm">
                <?php include("$root/admin/sidebar.php"); ?>
            </div>
            <div class="col-sm p-4">
                <h3>Users</h3>
                <?php
                    include("$root/modules/mysql.php");
                    $db = new MySQL();
                    $items = $db->fetchAll("SELECT * FROM CUSTOMERS ORDER BY id DESC");
                ?>
                <table class="table" style=" border-bottom: 1px solid #dee2e6;">
                    <thead class="thead">
                        <tr>
                            <th scope="col" style="border: none;">Namn</th>
                            <th scope="col" style="border: none;">Email</th>
                            <th scope="col" style="border: none;">Födelsedatum</th>
                            <?php if ($editAccess or $deleteAccess) { ?>
                                <th scope="col" style="border: none;">Åtgärder</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($items as $item) { ?>
                        
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-sm" style="max-width: 12rem; height: 8rem; overflow: hidden; text-align:center">
                                        <img src="<?php echo get_gravatar($email, 38); ?>" class="rounded-circle" width="38" height="38">
                                    </div>
                                    <div class="col-md">
                                        <h5 class="mb-1"><?php echo $item["firstname"]; ?></h5>
                                        <p><?php echo $item["lastname"] ?></p>
                                    </div>
                                </div>
                            </td>
                            <td style="text-align: center;" class="price">
                                <?php echo $item["email"] ?> 
                            </td>
                            <td style="text-align: center;" class="price">
                                <?php echo $item["birth_date"] ?> 
                            </td>
                            <?php if ($editAccess or $deleteAccess) { ?>
                                <td>
                                    <?php if ($editAccess) { ?>
                                        <a href="/admin/users/edit/index.php?pid=<?php echo $item["id"]; ?>" class="btn-edit"><img src="/images/icons/edit.svg"></a>
                                    <?php } ?>
                                    <?php if ($deleteAccess) { ?>
                                        <a href="#" class="btn-delete" data-toggle="modal" data-target="#deleteProduct<?php echo $item["id"]; ?>"><img src="/images/icons/delete.svg"></a> 
                                    <?php } ?>
                                </td>
                            <?php } ?>
                        </tr>
                        

                        <!-- Modal -->
                        <?php if ($deleteAccess) { ?>
                            <div class="modal fade" id="deleteProduct<?php echo $item["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteProductModal<?php echo $item["id"]; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteProductModal<?php echo $item["id"]; ?>">Är du säker på att du vill radera kontot?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm" style="max-width: 12rem; height: 8rem; overflow: hidden; text-align:center">
                                                <img src="<?php echo get_gravatar($email, 38); ?>" class="rounded-circle" width="38" height="38">
                                                </div>
                                                <div class="col-md">
                                                    <h5 class="mb-1"><?php echo $item["firstname"]; ?></h5>
                                                    <p><?php echo $item["lastname"] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#" type="button" class="btn btn-secondary" data-dismiss="modal">Avbryt</button>
                                            <a href="delete.php?id=<?php echo $item["id"]; ?>" type="button" class="btn btn-danger">Radera</a>
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