<?php
    if (!isset($url)) {
        $url = "/admin";
    }

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
        <a href="#database-group" class="sidebar-link list-group-item list-group-item-action" data-toggle="collapse">
            <img src="/images/icons/database.svg" width=18 height=18>
            <span class="ml-2">MySQL</span>
            <img src="/images/icons/left.svg" class="float-right collapsed-icon" width=18 height=18>
            <img src="/images/icons/down.svg" class="float-right expanded-icon" style="display: none;" width=18 height=18>
        </a>
        <div class="list-group collapse" id="database-group">
            <a href="/admin/database/connection" class="sidebar-link sub-link list-group-item list-group-item-action">
                Anslutning
            </a>
            <a href="/admin/database/tables" class="sidebar-link sub-link list-group-item list-group-item-action">
                Tabeller
            </a>
            <a href="/admin/database/content" class="sidebar-link sub-link list-group-item list-group-item-action">
                Innehåll
            </a>
        </div>
        <a href="#products-group" class="sidebar-link list-group-item list-group-item-action" data-toggle="collapse">
            <img src="/images/icons/laptop.svg" width=18 height=18>
            <span class="ml-2">Produkter</span>
            <img src="/images/icons/left.svg" class="float-right collapsed-icon" width=18 height=18>
            <img src="/images/icons/down.svg" class="float-right expanded-icon" style="display: none;" width=18 height=18>
        </a>
        <div class="list-group collapse" id="products-group">
            <a href="/admin/products/list" class="sidebar-link sub-link list-group-item list-group-item-action">
                Visa alla
            </a>
            <a href="/admin/products/add" class="sidebar-link sub-link list-group-item list-group-item-action">
                Lägg till
            </a>
        </div>
        <a href="#users-group" class="sidebar-link list-group-item list-group-item-action" data-toggle="collapse">
            <img src="/images/icons/people.svg" width=18 height=18>
            <span class="ml-2">Användare</span>
            <img src="/images/icons/left.svg" class="float-right collapsed-icon" width=18 height=18>
            <img src="/images/icons/down.svg" class="float-right expanded-icon" style="display: none;" width=18 height=18>
        </a>
        <div class="list-group collapse" id="users-group">
            <a href="/admin/users/list" class="sidebar-link sub-link list-group-item list-group-item-action">
                Visa alla
            </a>
            <a href="/admin/users/add" class="sidebar-link sub-link list-group-item list-group-item-action">
                Lägg till
            </a>
        </div>
        <a href="#orders-group" class="sidebar-link list-group-item list-group-item-action">
            <img src="/images/icons/payment.svg" width=18 height=18>
            <span class="ml-2">Beställningar</span>
            <img src="/images/icons/left.svg" class="float-right collapsed-icon" width=18 height=18>
            <img src="/images/icons/down.svg" class="float-right expanded-icon" style="display: none;" width=18 height=18>
        </a>
        <div class="list-group collapse" id="orders-group">
            <a href="/admin/orders/list" class="sidebar-link sub-link list-group-item list-group-item-action">
                Visa alla
            </a>
        </div>
        <a href="/" class="sidebar-link list-group-item list-group-item-action">
            <img src="/images/icons/code.svg" width=18 height=18>
            <span class="ml-2">Startsidan</span>
        </a>
        <a href="/" class="sidebar-link list-group-item list-group-item-action">
            <img src="/images/icons/settings.svg" width=18 height=18>
            <span class="ml-2">Inställningar</span>
        </a>
        <a href="/" class="sidebar-link list-group-item list-group-item-action">
            <img src="/images/icons/exit_to_app.svg" width=18 height=18>
            <span class="ml-2">Avsluta</span>
        </a>
    </div>
</nav>
