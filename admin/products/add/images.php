<?php $images = glob("../../../" . $_GET["dir"] . "/*.{jpg,jpeg,png,bmp}", GLOB_BRACE); ?>
<?php foreach($images as $image) { ?>
    <?php $parts = explode("/", $image);?>
    <div class="form-group form-check product-image p-0 mb-2 mr-2 checked" style="position: relative; top: 0; left: 0;">
        <div class="checked-icon" style="position: absolute; top: -3px; left: -2px; background-color: green; width: 28px; height: 30px; border-bottom-right-radius: 6px;">
            <img src="/images/icons/done.svg">
        </div>
        <input type="checkbox" checked id="image-<?php echo $parts[count($parts) - 1]; ?>" name="image-<?php echo $parts[count($parts) - 1]; ?>" hidden>
        <input type="text" value="<?php echo $parts[count($parts) - 1]; ?>" name="file-<?php echo $parts[count($parts) - 1]; ?>" hidden>
        <label class="from-check-label mb-0" for="image-<?php echo $parts[count($parts) - 1]; ?>">
            <div class="image-div">
                <img style="height: 10rem; display: block; margin: 0 auto;" src="/<?php echo $_GET["dir"] . "/" . $parts[count($parts) - 1]; ?>" alt="Image not found">
            </div>
        </label>
    </div>
<?php } ?>