<?php
    $images = glob($_GET["dir"] . "/*.{jpg,png,bmp}");
    var_dump($images);
    echo "Images from dir: " . $_GET["dir"];
    foreach($images as $image)
    {
        echo $image;
    }
?>