<!DOCTYPE html>
<html>
<head>
<title>Create Account</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> 
</head>
<body>

 <form action="action_page.php">
  <div class="container">
    <h1>Sign Up</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>
    <div class="row">
        <div class="col-md-2">
            <label for="first-name"><b>First Name</b></label>
        </div>
        <div class="col-md-2">
            <input type="text" placeholder="Enter First Name" name="first-name" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <label for="last-name"><b>Last Name</b></label>
        </div>
        <div class="col-md-2">
            <input type="text" placeholder="Enter Last Name" name="last-name" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <label for="date-of-birth"><b>Date of Birth</b></label>
        </div>
        <div class="col-md-2">
            <input type="text" placeholder="Enter Date of Birth" name="date-of-birth" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <label for="gender"><b>Gender</b></label>
        </div>
        <div class="col-md-2">
            <input type="radio" name="gender" value="male"> Male
            <input type="radio" name="gender" value="female"> Female
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <label for="email"><b>Email</b></label>
        </div>
        <div class="col-md-2">
            <input type="text" placeholder="Enter Email" name="email" required>
        </div>
    </div>
        
    <div class="row">
        <div class="col-md-2">
            <label for="psw"><b>Password</b></label>
        </div>
        <div class="col-md-2">
            <input type="password" placeholder="Enter Password" name="psw" required>
        </div>
    </div>
        
    <div class="row">
        <div class="col-md-2">
            <label for="psw-repeat"><b>Repeat Password</b></label>
        </div>
        <div class="col-md-2">
            <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
        </div>
    </div>
        
    <div class="row">
        <div class="col-md-2">
            <label for="mobile-number"><b>Mobile Number</b></label>
        </div>
        <div class="col-md-2">
            <input type="text" placeholder="Enter Mobile Number" name="mobile-number" required>
        </div>
    </div>
        
    <div class="row">
        <div class="col-md-2">
            <label for="address"><b>Address</b></label>
        </div>
        <div class="col-md-2">
            <input type="text" placeholder="Enter Address" name="address" required>
        </div>
    </div>
        

    <div class="clearfix">
        <button type="submit" class="btn signupbtn">Sign Up</button>
      <button type="button" class="btn cancelbtn">Cancel</button>
    </div>
  </div>
</form> 

</body>
</html> 