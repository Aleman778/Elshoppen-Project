<!-- Shows one comment -->
<?php include("$root/modules/product_stars.php"); ?>
<div id="<?php echo $review["id"]; ?>" class="container <?php echo "review";?>">
    <div class="row">
        <img src="<?php echo get_gravatar($review["email"], 38); ?>" class="rounded-circle m-2" width="38" height="38" style="margin-top:5px;">
        <div class="col-lg">
            <b><?php echo $review["firstname"] . " " . $review["lastname"]; ?></b>
            <?php createStars(5, 3, 15, 1, false); ?>
            <p class="mb-1"><?php echo $review["review"]; ?></p>
        </div>
    </div>
</div>