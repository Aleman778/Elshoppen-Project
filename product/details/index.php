<?php  
    $root = $_SERVER['DOCUMENT_ROOT'];
    if (!array_key_exists("id", $_GET)) {
        header("Location: /");
    }
?>
            
<!DOCTYPE html>
<html>
    <head>
        <!-- Include bootstrap css -->
        <?php include("$root/modules/bootstrap_css.php"); ?>
        <style>
            .carousel-control-prev {
                transition: background-color 0.5s ease;
            }
            
            .carousel-control-next {
                transition: background-color 0.5s ease;
            }

            .carousel-control-prev:hover {
                background-color: rgb(0, 0, 0, 0.2);
            }
            .carousel-control-next:hover {
                background-color: rgb(0, 0, 0, 0.2);
            }
        </style>
    </head>
        <body>
        <?php include("$root/header.php") ?>
        <?php 
            
            if (!array_key_exists("id", $_GET)) {
                header("Location: /");
            }

            include("$root/modules/review_stars.php");
            include("$root/modules/mysql.php");
            $db = new MySQL();
            $stmt = $db->prepare("SELECT * FROM PRODUCTS WHERE id=:id");
            $stmt->execute(array("id" => $_GET["id"]));
            $details = $stmt->fetch();
            $images = explode(",", $details["image_ref"]);

            $rating = 3.5; //Average rating hard coded
            $numReviews = 25;    
        ?>

        <div class="container">
            <?php if (!$details) { ?>
                <h1>Felkod 404</h1>
                <h2>Produkten som förfrågades finns inte i vårt register</h2>
                <a class="btn btn-primary" href="/">Gå tillbaka till startsidan</a>
            <?php }  else { ?>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/category/<?php echo $details["category"] ?>">
                    <?php echo $details["category"] ?></a>
                </li>
                <li class="breadcrumb-item active">
                    <?php echo $details["name"]; ?>
                </li>
                </ol>

                <div class="row">
                    <div class="col-md">
                        <!-- Image slideshow (carousel) -->
                        <div id="imageGallery" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php for ($i = 1; $i < count($images); $i++) { ?>
                                    <div class="carousel-item <?php if ($i == 1) echo "active"; ?>">
                                        <img class="carousel-img d-block w-100" src="<?php echo "/images/items/$images[0]/$images[$i]" ?>" alt="image">
                                    </div>
                                <?php } ?>
                            </div>
                            <a class="carousel-control-prev" href="#imageGallery" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#imageGallery" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md">
                        <!-- Product title -->
                        <h2><?php echo $details["name"] ?></h2>

                        <!-- Average ratings -->
                        <?php createStars(5, $rating, 28, $numReviews, true); ?>
                        
                        <!-- Price -->
                        <h4 style="margin: 12px; margin-top: 24px;"><?php echo $details["price"]; ?> kr</h4>

                        <!-- Buy product button -->
                        <div style="margin: 12px;">
                            <a class="btn btn-primary <?php if ($details["inventory"] == 0) echo "disabled"; ?>" href="#">Lägg i kundvagnen</a>
                            <a class="btn btn-secondary <?php if ($details["inventory"] == 0) echo "disabled"; ?>" href="#">Köp nu</a>
                            <?php if ($details["inventory"] == 0) { ?>
                                <p style="color: gray;">Det är slut i webblagret.</p>
                            <?php } else { ?>
                                <p style="color: gray;">Det finns <?php echo $details["inventory"]; ?>st kvar i webblagret.</p>
                            <?php } ?>
                        </div>

                        <!-- Product information -->
                        <p style="margin-left: 12px;"><?php echo $details["description"] ?></p>
                    </div>
                </div>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" role="tab" aria-controls="reviews" aria-selected="true" href="#reviews">Recensioner</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" role="tab" aria-controls="comments" aria-selected="false" href="#comments">Kommentarer</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                        a
                    </div>
                    <div class="tab-pane show active" id="comments" role="tabpanel" aria-labelledby="comments-tab">
                        <?php include("$root/modules/comments.php"); ?>
                    </div>
                </div>
            <?php } ?>
        </div>

        <?php include("$root/footer.php") ?>

        <!--  Include bootstrap scripts -->
        <?php include("$root/modules/bootstrap_js.php"); ?>

        <!-- fix footer position -->
        <script src="/footer.js"></script>

        <!-- comments script -->
        <script src="/modules/comments.js"></script>

        <!-- Carousel -->
        <script>
            $(document).ready(function() {
                var maxHeight = 0;
                $(".carousel-item").each(function() {
                    var h = $(this).height();
                    if (h > maxHeight) {
                        maxHeight = h;
                    }
                });
                $("#imageGallery").css("min-height", maxHeight);
                $("#imageGallery").css("max-height", maxHeight);
                $(".carousel-item").each(function() {
                    var y = maxHeight/2.0 - $(this).height()/2.0;
                    $(this).css("margin-top", y);
                });
            });
        </script>
    </body>
</html>
