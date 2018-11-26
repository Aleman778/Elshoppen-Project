<?php
    $images = explode(",", $item["image_ref"]);
?>

<div class="card card-item m-2" style="width: 16rem;">
    <div class="card-img-top" style="width: 16rem; height: 10rem; overflow: hidden; display:table-cell; text-align:center">
        <img class="align-middle" style="height: 10rem;" src="<?php echo "/images/items/$images[0]/$images[1]"; ?>" alt="Card image cap">
    </div>
    <div class="card-body">
        <h5 class="card-title" style="max-height: 48px; overflow: hidden;">
            <?php echo $item["name"] ?>
        </h5>
        <p class="card-subtitle pb-2"><?php echo (string) $item["price"] . " kr" ?></p>
        <?php if ((array_key_exists("quantity", $item))) { ?> 
        <p class="card-subtitle pb-2"> Antal = </p>
        <?php echo (string) $item["quantity"]; } ?>
        <a href="product/details?id=<?php echo $item["id"] ?>" class="btn btn-primary">Visa produkt</a>
    </div>
</div>