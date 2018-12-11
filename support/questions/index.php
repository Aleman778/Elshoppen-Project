<?php $root = $_SERVER['DOCUMENT_ROOT']; ?>
<!DOCTYPE html>
<html>
<head>
<title>Vanliga frågor - Elshoppen</title>
  <!-- Include basic libraries -->
  <?php include("$root/modules/bootstrap_css.php"); ?>
  <?php include("$root/header.php"); ?>
</head>


<body>

    <div id="main" class="container">

        <h1>Vanliga frågor</h1>

        <div id="row" class="container">
            <div class="card card-item m-2" style="width: 64rem;">
                <div class="card-body" style="background-color:  rgb(230, 230, 230);">
                    <h5 class="card-title" style="max-height: 48px; overflow: hidden;">
                        <b>Måste man ha ett konto för att handla på shoppen?</b> 
                    </h5>
                    <p>Ja, man måste ha ett konto.</p>
                </div>
            </div>
        </div>

        <div id="row" class="container">
            <div class="card card-item m-2" style="width: 64rem;">
                <div class="card-body" style="background-color:  rgb(230, 230, 230);">
                    <h5 class="card-title" style="max-height: 48px; overflow: hidden;">
                        <b>Kan man ändra sin email på sitt konto?</b> 
                    </h5>
                    <p>Ja, om man är inloggad så kan man trycka på sin profil bild och sedan trycka på mitt konto. Där kan man ändra alla konto uppgiter, inclusive email.</p>
                </div>
            </div>
        </div>
        
        <div id="row" class="container">
            <div class="card card-item m-2" style="width: 64rem;">
                <div class="card-body" style="background-color:  rgb(230, 230, 230);">
                    <h5 class="card-title" style="max-height: 48px; overflow: hidden;">
                        <b>Kan man avbryta en order?</b> 
                    </h5>
                    <p>Ja, det kan man. För att avbryta en order behöver du gå till kontakta oss sidan och skriva in din information samt ett medelande där du skriver vilken order du vill avbryta.</p>
                </div>
            </div>
        </div>

        <div id="row" class="container">
            <div class="card card-item m-2" style="width: 64rem;">
                <div class="card-body" style="background-color:  rgb(230, 230, 230);">
                    <h5 class="card-title" style="max-height: 48px; overflow: hidden;">
                        <b>När fylls produkt lagren på?</b> 
                    </h5>
                    <p>Våra produkt lager fylls på varje månad, men det gäller ej alla produkter. 
                    För att veta när och om en specifik produkter kommer finnas i lager måste du fråga oss. Det kan man göra på kontakta oss sidan.</p>
                </div>
            </div>
        </div>

        <div id="row" class="container">
            <div class="card card-item m-2" style="width: 64rem;">
                <div class="card-body" style="background-color:  rgb(230, 230, 230);">
                    <h5 class="card-title" style="max-height: 48px; overflow: hidden;">
                        <b>Jag har glömt mitt lösenord, hur kan jag komma åt mitt konto?</b> 
                    </h5>
                    <p>Om du har glömt ditt lösenord så måste du kontakta oss på kontakta oss sidan. Där så behöver du skriva in din information och så kommmer vi hjälpa dig inom några dagar.</p>
                    </div>
            </div>
        </div>

        <div id="row" class="container">
            <div class="card card-item m-2" style="width: 64rem;">
                <div class="card-body" style="background-color:  rgb(230, 230, 230);">
                    <h5 class="card-title" style="max-height: 48px; overflow: hidden;">
                        <b>Jag har inte fått min order än, när kommer den?</b> 
                    </h5>
                    <p>Du kan spåra din order på spåra din order sidan, det tar ett tag innan du får din order spårning. 
                    Om det står att din order ska vara levererad och du inte fått den så ska du kontakta oss på kontakta oss sidan så vi kan hjälpa dig. </p>
                </div>
            </div>
        </div>
    </div>

    <?php include("$root/footer.php"); ?>

    <!-- Include jQuery, popper and bootstrap  -->
    <?php include("$root/modules/bootstrap_js.php"); ?>

    <!-- fix footer position -->
    <script src="/footer.js"></script>

    </body>
</html>