<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/admin/access.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin - Databas tabeller</title>
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
                <h3>Databastabeller</h3>
                <h4>Tabeller i databasen db971229</h4>
                <?php
                    include("$root/modules/mysql.php");
                    $db = new MySQL();
                    $tables = $db->fetchAll("SHOW TABLES FROM db971229;");
                ?>
                <table class="table" style="border-bottom: 1px solid #dee2e6;">
                    <thead>
                        <tr>
                        <th scope="col" style="padding-left: 37px;">Tabellnamn</th>
                        <th scope="col">Attribut</th>
                        <th scope="col">Primär</th>
                        <th scope="col">Åtgärder</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tables as $table) { ?>
                            <?php 
                                $desc = $db->fetchAll("DESCRIBE " . $table[0]);
                            ?>
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="select<?php echo $table[0]; ?>">
                                        <label class="custom-control-label" for="select<?php echo $table[0]; ?>"><?php echo $table[0]; ?></label>
                                    </div>
                                </td>
                                <td>
                                    <?php
                                        for ($i = 0; $i < count($desc); $i++) {
                                            if ($i > 0)
                                                echo ", ";
                                            echo $desc[$i]["Field"];
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        $first = false;
                                        for ($i = 0; $i < count($desc); $i++) {
                                            if ($desc[$i]["Key"] == "PRI") {
                                                if ($first)
                                                    echo ", ";
                                                echo $desc[$i]["Field"];
                                                $first = true;
                                            }
                                        }
                                    ?>
                                </td>
                                <td>
                                    <a href="edit.php?table=<?php echo $table[0]; ?>" class="btn-edit"><img src="/images/icons/edit.svg"></a>
                                    <a href="delete.php?table=<?php echo $table[0]; ?>" class="btn-delete"><img src="/images/icons/delete.svg"></a> 
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php include("$root/modules/bootstrap_js.php"); ?>

        <!-- Run basic admin script -->
        <script src="/admin/basic.js"></script>
    </body>
</html>
