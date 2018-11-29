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

        <!-- Custom styling -->
        <link rel="stylesheet" href="style.css">
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
                            <a class="btn btn-primary <?php if ($details["inventory"] == 0) echo "disabled"; ?>" href="/account/cart/add_item.php?id=<?php echo $_GET["id"]; ?>">Lägg i kundvagnen</a>
                            <a class="btn btn-secondary <?php if ($details["inventory"] == 0) echo "disabled"; ?>" href="/account/cart/payinfo.php?item=<?php echo $_GET["id"]; ?>">Köp nu</a>
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
                    <div class="tab-pane mb-4" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                        a
                    </div>
                    <div class="tab-pane show active mb-4" id="comments-tab" role="tabpanel" aria-labelledby="comments-tab">
                        <!-- Select all comments from the given product. -->

                        <!-- Count how many comments there are in total -->
                        <?php 
                            $sql = "SELECT COUNT(*) FROM COMMENTS WHERE product_id=:id AND reply_id=0";
                            $stmt = $db->prepare($sql);
                            $stmt->execute(array("id" => $_GET["id"]));
                            $numComments = $stmt->fetch()["COUNT(*)"];
                        ?>
                        <?php if ($numComments == 0) { ?>
                            <h4 class="mt-3">Inga kommentarer</h4>
                        <?php } else { ?>
                            <h4 class="mt-3"><?php echo $numComments; ?> kommentarer</h4>
                        <?php } ?>

                        <!-- Add a new comment -->
                        <div class="container">
                            <?php if ($loggedIn) { ?>
                                <div class="row">
                                    <img src="<?php echo get_gravatar($email, 38); ?>" class="rounded-circle m-2" width="38" height="38" style="margin-top:5px;">
                                    <div class="col-lg form-group">
                                        <textarea style="resize: none;" class="form-control" id="comment-msg" rows="1" maxlength="200" placeholder="Lägg till en kommentar..."></textarea>
                                    </div>
                                </div>
                                <div style="min-height: 48px; max-height: 48px; min-width=100%;">
                                    <button class="btn btn-primary float-right" id="comment-btn" type="button" product="<?php echo $_GET["id"]; ?>" disabled>Kommentera</button>
                                </div>
                            <?php } else { ?>
                                <h5>Du måste vara inloggad för att skriva kommentarer.</h5>
                            <?php } ?>
                        </div>

                        <!-- Show comments -->
                        <div id="comments" product="<?php echo $_GET["id"]; ?>" count="<?php echo $numComments; ?>">
                            <?php include("$root/modules/load_comments.php"); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div id="comment-loader" class="w-100 mb-4" style="text-align:center; display: none;">
                <svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                    <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
                </svg><br>
                Laddar in fler kommentarer...
            </div>
        </div>

        <?php include("$root/footer.php") ?>

        <!--  Include bootstrap scripts -->
        <?php include("$root/modules/bootstrap_js.php"); ?>

        <!-- fix footer position -->
        <script src="/footer.js"></script>

        <!-- Comment script -->
        <script src="/modules/comment.js"></script>

        <!-- Custom script for dynamic loading of comments and carousel height fixes -->
        <script>
            $(document).ready(function() {
                var loadingComments = false;
                var numComments = $("#comments").attr("count");
                loadComments();
                
                $(window).scroll(function() {
                    loadComments();
                });

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

                function loadComments() {
                    var scroll = $(window).scrollTop() + $(window).height();
                    if (!loadingComments && (scroll > $(document).height() - 300)) {
                        loadingComments = true;
                        if ($(".comment").length >= numComments)
                            return;

                        $("#comment-loader").show();
                        $.ajax({
                            method: "POST",
                            url: "/modules/load_comments.php",
                            data: {
                                product_id: $("#comments").attr("product"),
                                prev_id: $(".comment").last().attr("id"),
                            }
                        }).done(function(html) {
                            $("#comments").append(html);
                            $("#comment-loader").hide();
                            loadingComments = false;
                        });
                    }
                }
            });
        </script>
    </body>
</html>
