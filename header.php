<?php
  $userName = "Test user";
  $loggedIn = true;
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">GIGANTEN</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
    <ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
  <div class="navbar navbar-right">
    <?php if ($loggedIn) { ?>
      <div class="row">
        <div class="col-sm rounded-circle">
          <img src="res/profiles/cat.jpg" class="rounded-circle" width="48" height="48">
        </div>
        <div class="container col-sm">
          <?php echo $userName ?>
        </div>
      </div>
    <?php } else { ?>
      <a class="btn btn-primary" href="login/" type="submit">Logga in</a>
    <?php } ?>

  </div>
</nav>
