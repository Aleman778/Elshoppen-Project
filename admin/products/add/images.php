<?php
    $images = glob("../../../" . $_GET["dir"] . "/*.{jpg,png,bmp}", GLOB_BRACE);
    $index = 0;
?>
<?php foreach($images as $image) { ?>
    <?php $parts = explode("/", $image); $index++; ?>
    <div class="form-group form-check product-image p-0 ml-2 image-checked" style="overflow: hidden;">
        <input type="checkbox" checked id="image-<?php echo $index; ?>" class="image-checkbox" name="image-<?php echo $index; ?>" hidden>
        <input type="text" value="<?php echo $parts[count($parts) - 1]; ?>" name="file-<?php echo $index; ?>" hidden>
        <label class="from-check-label" for="image-<?php echo $index; ?>">
            <div class="image-div">
                <img style="height: 10rem; display: block; margin: 0 auto;" src="/<?php echo $_GET["dir"] . "/" . $parts[count($parts) - 1]; ?>" alt="">
            </div>
        </label>
    </div>
<?php } ?>