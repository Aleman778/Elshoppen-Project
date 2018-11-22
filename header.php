<?php
  $userName = "Unknown User";
  $userImage = "cat.jpg";
  $numItemsInCart = 50;
  $loggedIn = true;
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
          <li class="nav-item">
            <a class="mt-3" href="/account/kundvagn">
              <img src="/images/icons/cart.png" width="32" height="32" style="margin-top: 8px;">
              <span class="badge badge-light rounded-circle align-middle" style="width: 24px; height: 24px; padding-top: 6px; margin-top: 8px;"><?php echo $numItemsInCart ?></span>
            </a>
          </li>
          <li class="nav-item dropdown ml-2">
            <a class="btn btn-primary py-1" href="#" id="userDropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="row">
                <div class="col-sm rounded-circle">
                  <img src="/images/profiles/<?php echo $userImage ?>" class="rounded-circle" width="38" height="38">
                </div>
                <div class="col-sm pl-0">
                  <p class="p-0 mt-1 mb-0"><?php echo $userName ?></p>
                </div>
              </div>
            </a>
            <div class="dropdown-menu" aria-labelledby="userDropdownMenu">
                <a class="dropdown-item" href="account/details">Mitt konto</a>
                <a class="dropdown-item" href="/account/orders">Mina beställningar</a>
                <a class="dropdown-item" href="/account/kundvagn">Kundvagn</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/account/signout">Logga ut</a>
              </div>
          </li>
        <?php } else { ?> <!-- If the user is not logged in then this code is shown -->
          <li class="nav-item">
            <a class="btn btn-primary" href="login/" type="submit">Logga in</a>
          </li>
        <?php } ?>
        </ul>
      </div>
    </div>
  </div>
</nav>
