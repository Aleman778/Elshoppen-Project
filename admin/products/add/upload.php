<?php

    $targetDir = "../../../" . "/images/items/" . $_POST["folder"] . "/";
    $targetFilename = basename($_FILES["file"]["name"]);
    $targetFile = $targetDir . $targetFilename;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
    
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Filen är ingen bild. ";
        $uploadOk = 0;
    }

    if (file_exists($targetFile)) {
        echo "Filen \"$targetFilename\" finns redan. ";
        $uploadOk = 0;
    }

    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    if ($_FILES["file"]["size"] > 500000) {
        echo "Filen är för stor. Max är 500 kB. ";
        $uploadOk = 0;
    }
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "Enbart JPG, JPEG, PNG & GIF filer är tillåtna. ";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo "Filen misslyckades med att laddas upp. ";
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
?>
<div class="form-group form-check product-image p-0 mb-2 mr-2 checked">
    <div class="checked-icon" style="position: absolute; top: -3px; left: -2px; background-color: green; width: 28px; height: 30px; border-bottom-right-radius: 6px;">
        <img src="/images/icons/done.svg">
    </div>
    <input type="checkbox" checked id="image-<?php echo $targetFilename; ?>" name="image-<?php echo $targetFilename; ?>" hidden>
    <input type="text" value="<?php echo $targetFilename; ?>" name="file-<?php echo $targetFilename; ?>" hidden>
    <label class="from-check-label mb-0" for="image-<?php echo $uploadFilename; ?>">
        <div class="image-div">
            <img style="height: 10rem; display: block; margin: 0 auto;" src="<?php echo $targetFile; ?>" alt="Image not found">
        </div>
    </label>
</div>
<?php
        } else {
            echo "Något gick fel med uppladdningen.";
        }
    }
?>
