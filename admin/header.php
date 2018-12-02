<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];

    $firstname = "";
    $lastname = "";
    $email = "";
    $role = "Guest";
    $cart = 0;

    if (session_status() == PHP_SESSION_NONE)
        session_start();
    if (array_key_exists("firstname", $_SESSION))
        $firstname = $_SESSION["firstname"];
    if (array_key_exists("lastname", $_SESSION))
        $lastname = $_SESSION["lastname"];
    if (array_key_exists("email", $_SESSION))
        $email = $_SESSION["email"];
    if (array_key_exists("role", $_SESSION))
        $role = $_SESSION["role"];

    if ($role != "Admin")
        header("Location: /");

    include("$root/modules/gravatar.php");
?>

<nav id="header" class="navbar navbar-expand-lg navbar-dark bg-primary py-1">
    <a class="navbar-brand" href="/"><b>Admin</b>ELSHOPPEN</a>
    <ul class="navbar-nav ml-auto p-0">
        <li class="nav-item dropdown ml-2">
            <a class="py-1" href="#" style="color: white; text-decoration: none;" id="userDropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="<?php echo get_gravatar($email, 38); ?>" class="rounded-circle" width="38" height="38">
            </a>
            <div id="profile-drop" class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdownMenu" style="padding-top: 0px;">
                <a class="dropdown-item " href="/account/profile" style="background-color: rgb(230, 230, 230); border-top-left-radius: .25rem; border-top-right-radius: .25rem;">
                    <div class="row">
                        <div class="col-sm p-0" style="min-width: 48px; display: table-cell; text-align: center;">
                            <img src="<?php echo get_gravatar($email, 64); ?>" class="rounded-circle" width="64" height="64" style="margin-top:5px;">
                        </div>
                        <div class="col-lg p-0" style="text-align: center;">
                            <b class="text-nowrap"><?php echo $firstname . " " . $lastname . " - " . $role; ?></b><br>
                            <span class="text-nowrap"><?php echo $email ?></span>
                        </div>
                    </div>
                </a>
                <a class="dropdown-item" href="/" style="padding-left: 56px;">Avsluta</a>
                <a class="dropdown-item" href="/account/signout" style="padding-left: 56px;">Logga ut</a>
            </div>
        </li>
    </ul>
</nav>