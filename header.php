<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];

    $loggedIn = false;
    $firstname = "";
    $lastname = "";
    $email = "";
    $role = "Guest";
    $cart = 0;

    if (array_key_exists("customer_id", $_SESSION)) {
        $loggedIn = true;
        
        include("$root/modules/mysql.php");

        $db = new MySQL();
        $stmt = $db->prepare("SELECT quantity FROM CART WHERE customer_id=:id");
        $stmt->execute(array("id" => $_SESSION["customer_id"]));
        $data = $stmt->fetchAll();
        foreach ($data as $d) {
            $cart += $d[0];
        }
    }
    if (array_key_exists("firstname", $_SESSION))
        $firstname = $_SESSION["firstname"];
    if (array_key_exists("lastname", $_SESSION))
        $lastname = $_SESSION["lastname"];
    if (array_key_exists("email", $_SESSION))
        $email = $_SESSION["email"];
    if (array_key_exists("role", $_SESSION))
        $role = $_SESSION["role"];

    include("$root/modules/gravatar.php");
?>

<style>
    #searchbar::placeholder { color: rgba(210, 210, 210) !important; opacity: 1; }
    #searchbar:-ms-input-placeholder { color: rgba(210, 210, 210) !important; }
    #searchbar::-ms-input-placeholder { color: rgba(210, 210, 210) !important; }
    #searchbar {
        background-color: rgba(255,255,255,0.2);
        border: none;
        color: white;
        width: 500px;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
        transition: background-color 0.5s;
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0), 0 0 8px rgba(0, 0, 0, 0);
    }
    #searchaddon {
        border: none;
        padding: 5px;
        padding-left: 8px;
        background-color: rgba(255,255,255,0.2);
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        transition: background-color 0.5s;
    }
    #searchbar:focus {
        background-color: rgba(255,255,255,0.3);
    }
    #searchaddon:hover {
        background-color: rgba(255,255,255,0.3);
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary py-1 mb-4">
    <a class="navbar-brand" href="/">ELSHOPPEN</a>
    <div id="searchdiv" class="col-sm p-0 mx-2" style="max-height: 40px;">
        <form action="/product/search/index.php" method="get" class="form-inline">
            <div class="row m-0" style="width: 100%; overflow: hidden;">
                <div class="input-group-prepend col-sm p-0" style="margin-right: 0px; max-width: 37px;">
                    <a href="/product/search/index.php?searchterm=" id="searchbtn">
                        <span class="input-group-text" id="searchaddon">
                            <img src="/images/icons/search.svg" width="24" height="24" style="margin-top: 4px;">
                        </span>
                    </a>
                </div>
                <input id="searchbar" name="searchterm" class="form-control col-xlg" type="search" placeholder="Sök i web-shoppen" aria-label="Search">
            </div>
        </form>
    </div>
    <ul class="navbar-nav ml-auto p-0">
        <?php if ($loggedIn) { ?>
            <li class="nav-item dropdown ml-2">
                <a href="/account/cart" class="mr-3" style="position: relative; left: 0px; top: 0px;"><img src="/images/icons/cart.svg" width="30" height="30"><span class="badge badge-dark" style="position: absolute; left: 18px; top: 12px; <?php if ($cart == 0) echo "display: none;" ?>"><?php echo $cart; ?></span></a>
                <a class="py-1" href="#" id="userDropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="<?php echo get_gravatar($email, 38); ?>" class="rounded-circle" width="38" height="38">
                </a>
                <div id="profile-drop" class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdownMenu" style="padding-top: 0px;">
                    <a class="dropdown-item" href="/account/profile" style="background-color: rgb(230, 230, 230); border-top-right-radius: 0; border-bottom-right-radius: 0; padding-right: 0;">
                        <div class="row">
                            <img src="<?php echo get_gravatar($email, 38); ?>" class="rounded-circle" width="38" height="38" style="margin-top:5px;">
                            <div class="col-lg p-0 ml-2">
                                <b class="text-nowrap"><?php echo $firstname . " " . $lastname; ?></b><br>
                                <span class="text-nowrap"><?php echo $email ?></span>
                            </div>
                        </div>
                    </a>
                    <a class="dropdown-item" href="/account/profile" style="padding-left: 56px;">Mitt konto</a>
                    <a class="dropdown-item" href="/account/orders" style="padding-left: 56px;">Mina beställningar</a>
                    <a class="dropdown-item" href="/account/cart" style="padding-left: 56px;">Kundvagn</a>
                    <?php if ($role == "Admin" or $role == "Moderator") { ?>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/admin" style="padding-left: 56px;"><?php echo $role; ?> dashboard</a>
                    <?php } ?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/account/signout" style="padding-left: 56px;">Logga ut</a>
                </div>
            </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a class="btn btn-primary" href="/account/signin">Logga in</a>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>