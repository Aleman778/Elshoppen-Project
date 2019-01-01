<?php
    if (!isset($url)) {
        $url = "/admin";
    }

    $url = $_SERVER['REQUEST_URI'];
?>
<nav id="sidebar" url="<?php echo $url; ?>" class="navbar-dark bg-dark" style="min-height: 100%; color: white;">
    <div class="sidebar-header row m-0 p-2 mb-2">
        <img src="<?php echo get_gravatar($email, 48); ?>" class="rounded-circle" width="48" height="48" style="margin-top:5px;">
        <div class="col-lg small">
            <?php echo $firstname . " " . $lastname; ?><br>
            <b><?php echo $role; ?></b><br>
            <span class="badge badge-success" style="width: 10px; height: 10px;"> </span>
            Online
        </div>
    </div>

    <div class="list-group list-group-flush">
        <a href="/admin" class="sidebar-link list-group-item list-group-item-action">
            <img src="/images/icons/dashboard.svg" width=18 height=18>
            <span class="ml-2">Dashboard</span>
        </a>
        <?php if (checkAccess("/admin/database/")) { ?>
            <a href="#database-group" class="sidebar-link list-group-item list-group-item-action collapsed" data-toggle="collapse">
                <img src="/images/icons/database.svg" width=18 height=18>
                <span class="ml-2">MySQL</span>
                <img src="/images/icons/left.svg" class="float-right collapse-icon" width=18 height=18>
            </a>
            <div class="list-group collapse" id="database-group">
                <?php if (checkAccess("/admin/database/connection/")) { ?>
                    <a href="/admin/database/connection/" class="sidebar-link sub-link list-group-item list-group-item-action">
                        Anslutning
                    </a>
                <?php } ?>
                
                <?php if (checkAccess("/admin/database/tables/")) { ?>
                    <a href="/admin/database/tables/" class="sidebar-link sub-link list-group-item list-group-item-action">
                        Tabeller
                    </a>
                <?php } ?>
                
                <?php if (checkAccess("/admin/database/content/")) { ?>
                    <a href="/admin/database/content/" class="sidebar-link sub-link list-group-item list-group-item-action">
                        Innehåll
                    </a>
                <?php } ?>
            </div>
        <?php } ?>
        <?php if (checkAccess("/admin/products/")) { ?>
            <a href="#products-group" class="sidebar-link list-group-item list-group-item-action collapsed" data-toggle="collapse">
                <img src="/images/icons/laptop.svg" width=18 height=18>
                <span class="ml-2">Produkter</span>
                <img src="/images/icons/left.svg" class="float-right collapse-icon" width=18 height=18>
            </a>
            <div class="list-group collapse" id="products-group">
                <?php if (checkAccess("/admin/products/list/")) { ?>
                    <a href="/admin/products/list/" class="sidebar-link sub-link list-group-item list-group-item-action">
                        Visa alla
                    </a>
                <?php } ?>
                <?php if (checkAccess("/admin/products/add/")) { ?>
                    <a href="/admin/products/add/" class="sidebar-link sub-link list-group-item list-group-item-action">
                        Lägg till
                    </a>
                <?php } ?>
            </div>
        <?php } ?>
        <?php if (checkAccess("/admin/users/")) { ?>
            <a href="#users-group" class="sidebar-link list-group-item list-group-item-action collapsed" data-toggle="collapse">
                <img src="/images/icons/people.svg" width=18 height=18>
                <span class="ml-2">Användare</span>
                <img src="/images/icons/left.svg" class="float-right collapse-icon" width=18 height=18>
            </a>
            <div class="list-group collapse" id="users-group">
                <?php if (checkAccess("/admin/users/list/")) { ?>
                    <a href="/admin/users/list/" class="sidebar-link sub-link list-group-item list-group-item-action">
                        Visa alla
                    </a>
                <?php } ?>
                <?php if (checkAccess("/admin/users/add/")) { ?>
                    <a href="/admin/users/add/" class="sidebar-link sub-link list-group-item list-group-item-action">
                        Lägg till
                    </a>
                <?php } ?>
            </div>
        <?php } ?>
        <a href="/admin/comments/list" class="sidebar-link list-group-item list-group-item-action">
            <img src="/images/icons/comment.svg" width=18 height=18>
            <span class="ml-2">Kommentarer</span>
        </a>
        <?php if (checkAccess("/admin/orders/")) { ?>
            <a href="/admin/orders/list/" class="sidebar-link list-group-item list-group-item-action">
                <img src="/images/icons/payment.svg" width=18 height=18>
                <span class="ml-2">Beställningar</span>
            </a>
        <?php } ?>
        <?php if (checkAccess("/admin/frontpage/")) { ?>
            <a href="/admin/frontpage/" class="sidebar-link list-group-item list-group-item-action">
                <img src="/images/icons/code.svg" width=18 height=18>
                <span class="ml-2">Startsidan</span>
            </a>
        <?php } ?>
        <?php if (checkAccess("/admin/settings/")) { ?>
            <a href="/admin/settings/" class="sidebar-link list-group-item list-group-item-action">
                <img src="/images/icons/settings.svg" width=18 height=18>
                <span class="ml-2">Inställningar</span>
            </a>
        <?php } ?>
        <a href="/" class="sidebar-link list-group-item list-group-item-action">
            <img src="/images/icons/exit_to_app.svg" width=18 height=18>
            <span class="ml-2">Avsluta</span>
        </a>
    </div>
</nav>
