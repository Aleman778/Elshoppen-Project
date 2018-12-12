                        <!-- Count how many reviews there are in total -->
                        <?php 
                            $sql = "SELECT COUNT(*) FROM REVIEWS WHERE product_id=:id";
                            $stmt = $db->prepare($sql);
                            $stmt->execute(array("id" => $_GET["id"]));
                            $numReviews = $stmt->fetch()["COUNT(*)"];
                        ?>
                        
                        <?php if ($numReviews == 0) { ?>
                            <h4 class="mt-3">Inga recensioner</h4>
                        <?php } else { ?>
                            <h4 class="mt-3"><?php echo $numReviews; ?> recensioner</h4>
                        <?php } ?>

                        <!-- Add a new review -->
                        <div class="container">
                            <?php if ($loggedIn) { ?>
                                <div class="row">
                                    <img src="<?php echo get_gravatar($email, 38); ?>" class="rounded-circle m-2" width="38" height="38" style="margin-top:5px;">
                                    <div class="col-lg form-group">
                                        <label for="rating">Ge betyg från 1 till 5 (1 = dålig, 5 = jättebra):</label>
                                        <input type="number" id="rating" name="rating" min="1" max="5">
                                        <textarea style="resize: none;" class="form-control" id="review-msg" rows="1" maxlength="500" placeholder="Lägg till en recension..."></textarea>
                                    </div>
                                </div>
                                <div style="min-height: 48px; max-height: 48px; min-width=100%;">
                                    <button class="btn btn-primary float-right" id="review-btn" type="button" product="<?php echo $_GET["id"]; ?>" disabled>Publisera</button>
                                </div>
                            <?php } else { ?>
                                <h5>Du måste vara inloggad för att skriva recensioner.</h5>
                            <?php } ?>
                        </div>

                        <!-- Show reviewss -->
                        <div id="reviews" product="<?php echo $_GET["id"]; ?>" count="<?php echo $numReviews; ?>">
                            <?php include("$root/modules/load_reviews.php"); ?>
                        </div>
