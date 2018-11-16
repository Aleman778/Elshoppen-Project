
 <!DOCTYPE html>
<html>
<head>
  <title>Page Title</title>
  <?php include("../modules/bootstrap_css.php") ?>
</head>
  <body>
    <?php include("../header.php") ?>

    <div class="container">
      <form action="action_page.php">
          <h1>Login</h1>
          <p>Please fill in this form to login.</p>
          <hr>
            <div class="row">
              <div class="col-md-1">
                <label for="uname"><b>Username</b></label>
              </div>
              <div class="col-md-1">
                <input type="text" placeholder="Enter Username" name="uname" required>
              </div>
            </div>
          <div class="row">
            <div class="col-md-1">
              <label for="psw"><b>Password</b></label>
            </div>
            <div class="col-md-1">
              <input type="password" placeholder="Enter Password" name="psw" required>
            </div>
          </div>
            <button type="submit" class="btn loginbtn">Login</button>
            <button type="button" class="btn cancelbtn">Cancel</button>
          </div>
      </form> 
    </div>
     
    <?php include("../footer.php") ?>
    <?php include("../modules/bootstrap_js.php") ?>

    <!-- fix footer position -->
    <script src="../footer.js"></script>
  </body>
</html> 