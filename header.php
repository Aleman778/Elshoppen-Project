<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];

    $loggedIn = false;
    $firstname = "";
    $lastname = "";
    $email = "";
    $role = "Guest";
    $cart = 0;

    if (session_status() == PHP_SESSION_NONE)
        session_start();
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
<nav class="navbar navbar-expand-lg navbar-dark bg-primary py-1 mb-4" style="box-shadow: 0px 0px 12px #888888;">
    <a class="navbar-brand" href="/">ELSHOPPEN</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="/">Startsida<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Kundservice<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Kontakt<span class="sr-only">(current)</span></a>
        </li>
        </ul>
        <form action="/product/search/index.php" method="get" class="form-inline mx-2 p-0 col-lg">
        <div class="input-group p-0 col-lg">
            <div class="input-group-prepend">
            <a href="/product/search/index.php">
                <span class="input-group-text p-1" id="basic-addon1" style="background-color: white; border: none; border-top-right-radius: 0; border-bottom-right-radius: 0;">
                <img src="/images/icons/search.png" width="30" height="30">
                </span>
            </a>
            </div>
            <input id="searchbar" name="searchterm" class="form-control mr-sm-2" type="search" placeholder="Sök i web-shoppen" aria-label="Search"  style="border: none;max-width: 500px;
    min-width: 200px;">
        </div> 
        </form>
        <div class="navbar navbar-right p-0">
        <ul class="navbar-nav">
            <?php if ($loggedIn) { ?> <!-- The following code is shown if user is logged in -->
                <li class="nav-item dropdown ml-2">
                    <a href="/account/cart" class="mr-3" style="position: relative; left: 0px; top: 0px;"><img src="/images/icons/cart.svg" width="30" height="30"><span class="badge badge-dark" style="position: absolute; left: 18px; top: 12px; <?php if ($cart == 0) echo "display: none;" ?>"><?php echo $cart; ?></span></a>
                    <a class="py-1" href="#" id="userDropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="<?php echo get_gravatar($email, 38); ?>" class="rounded-circle" width="38" height="38">
                    </a>
                    <div id="profile-drop" class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdownMenu" style="padding-top: 0px;">
                        <a class="dropdown-item" href="/account/profile" style="background-color: rgb(230, 230, 230); border-top-left-radius: .25rem; border-top-right-radius: .25rem;">
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
                        <?php if ($role == "Admin" or $role == "Moderator" or $role = "Kundtjänst") { ?>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/admin" style="padding-left: 56px;"><?php echo $role; ?> dashboard</a>
                        <?php } ?>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/account/signout" style="padding-left: 56px;">Logga ut</a>
                    </div>
                </li>
            <?php } else { ?> <!-- If the user is not logged in then this code is shown -->
                <li class="nav-item">
                    <a class="btn btn-primary" href="/account/signin">Logga in</a>
                </li>
            <?php } ?>
            </ul>
        </div>
        </div>
    </div>
</nav>