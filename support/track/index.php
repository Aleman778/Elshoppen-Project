<?php $root = $_SERVER['DOCUMENT_ROOT']; ?>
<!DOCTYPE html>
<html>
<head>
<title>Spåra din leverans - Elshoppen</title>
  <!-- Include basic libraries -->
  <?php include("$root/modules/bootstrap_css.php"); ?>
  <?php include("$root/header.php"); ?>
</head>


<body>

    <div id="main" class="container">

        <h1>Spåra din leverans</h1>
        <div id="row" class="container">
        <form action="sent.php" method="post">
            <div  class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="txtFName" class="form-control" placeholder="Förnamn *" value="" required/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="txtEName" class="form-control" placeholder="Efternamn *" value="" required/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="txtPhone" class="form-control" placeholder="Order ID  *" value="" required/>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="btnSubmit" class="btnContact" value="Skicka mail" />
                    </div>
                </div>
            </div>
        </form>
       </div>
    </div>

    <?php include("$root/footer.php"); ?>

    <!-- Include jQuery, popper and bootstrap  -->
    <?php include("$root/modules/bootstrap_js.php"); ?>

    <!-- fix footer position -->
    <script src="/footer.js"></script>

    </body>
</html>