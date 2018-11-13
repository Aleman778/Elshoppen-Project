
 <!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
  <?php include "../header.php" ?>

  <form action="action_page.php">
  <div class="container">
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

</body>
</html> 