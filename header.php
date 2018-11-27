<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];

    $loggedIn = false;
    $firstname = "";
    $lastname = "";
    $email = "";

    if (session_status() == PHP_SESSION_NONE)
        session_start();
    if (array_key_exists("customer_id", $_SESSION))
        $loggedIn = true;
    if (array_key_exists("firstname", $_SESSION))
        $firstname = $_SESSION["firstname"];
    if (array_key_exists("lastname", $_SESSION))
        $lastname = $_SESSION["lastname"];
    if (array_key_exists("email", $_SESSION))
        $email = $_SESSION["email"];

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
                <!--<li class="nav-item">
                    <a class="mt-3" href="/account/cart">
                    <img src="/images/icons/cart.png" width="32" height="32" style="margin-top: 8px;">
                    <span class="badge badge-light rounded-circle align-middle" style="width: 24px; height: 24px; padding-top: 6px; margin-top: 8px;"><?php echo "0"; ?></span>
                    </a>
                </li>-->
                <li class="nav-item dropdown ml-2">
                    <a class="py-1" href="#" id="userDropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="<?php echo get_gravatar($email, 38); ?>" class="rounded-circle" width="38" height="38">
                    </a>
                    <div id="profile-drop" class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdownMenu" style="padding-top: 0px;">
                        <a class="dropdown-item" href="account/details" style="background-color: rgb(230, 230, 230); border-top-left-radius: .25rem; border-top-right-radius: .25rem;">
                            <div class="row">
                                <div class="col-sm p-0" style="min-width: 48px;">
                                    <img src="<?php echo get_gravatar($email, 38); ?>" class="rounded-circle" width="38" height="38" style="margin-top:5px;">
                                </div>
                                <div class="col-lg p-0">
                                    <b class="text-nowrap"><?php echo $firstname . " " . $lastname; ?></b><br>
                                    <span class="text-nowrap"><?php echo $email ?></span>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item" href="/account/profile" style="padding-left: 56px;">Mitt konto</a>
                        <a class="dropdown-item" href="/account/orders" style="padding-left: 56px;">Mina beställningar</a>
                        <a class="dropdown-item" href="/account/cart" style="padding-left: 56px;">Kundvagn</a>
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