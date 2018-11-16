<!DOCTYPE html>
<html>
<head>
<title>Skapa ett konto</title>
<?php include("../modules/bootstrap_css.php") ?>
</head>
<body>
    <?php include("../header.php") ?>
    <div class="container">
        <form action="action_page.php">
        <h1>Skapa ett konto</h1>
        <p>Fyll i rutorna nedan för att skapa ett konto.</p>
        <hr>
        <div class="row mb-2">
            <div class="col-md-2">
                <label for="first-name"><b>Förnamn</b></label>
            </div>
            <div class="col-md-2">
                <input class="form-control" type="text" placeholder="Fyll i förnamn" name="first-name" required>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-2">
                <label for="last-name"><b>Efternamn</b></label>
            </div>
            <div class="col-md-2">
                <input class="form-control" type="text" placeholder="Fyll i efternamn" name="last-name" required>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-2">
                <label for="date-of-birth"><b>Födelsedatum</b></label><!--hafhadfjklahsdfkj-->
            </div>
            <div class="col-md-2">
                <input class="form-control" type="date" placeholder="Fyll i födelsedatum" name="bday" required>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-2">
                <label for="gender"><b>Kön</b></label>
            </div>
            <div class="col-md-2">
                <input type="radio" name="gender" value="male"> Man
                <input type="radio" name="gender" value="female"> Kvinna
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-2">
                <label for="email"><b>Epost</b></label>
            </div>
            <div class="col-md-2">
                <input class="form-control" type="text" placeholder="Fyll i epost" name="email" required>
            </div>
        </div>
        <br>

        <div class="row mb-2">
            <div class="col-md-2">
                <label for="psw"><b>Lösenord</b></label>
            </div>
            <div class="col-md-2">
                <input class="form-control" type="password" placeholder="Fyll i lösenord" name="psw" required>
            </div>
        </div>
            
        <div class="row mb-2">
            <div class="col-md-2">
                <label for="psw-repeat"><b>Repetera lösenord</b></label>
            </div>
            <div class="col-md-2">
                <input class="form-control" type="password" placeholder="Repetera lösenord" name="psw-repeat" required>
            </div>
        </div>
        <br>
            
        <div class="row mb-2">
            <div class="col-md-2">
                <label for="mobile-number"><b>Mobilnummer</b></label>
            </div>
            <div class="col-md-2">
                <input class="form-control" type="text" placeholder="Fyll i mobilnummer" name="mobile-number" required>
            </div>
        </div>
            
        <div class="row">
            <div class="col-md-2">
                <label for="address"><b>Adress</b></label>
            </div>
            <div class="col-md-2">
                <input class="form-control" type="text" placeholder="Fyll i adress" name="address" required>
            </div>
        </div>
            

        <div class="clearfix">
            <button type="submit" class="btn btn-primary">Skapa</button>
            <a href="/login" class="btn btn-secondary">Avbryt</a>
            <hr>
        </div>
        </form> 
    </div>

    <?php include("../footer.php") ?>

    </body>
</html> 