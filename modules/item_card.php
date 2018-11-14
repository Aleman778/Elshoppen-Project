<div class="card card-item m-2" style="width: 16rem;">
  <div class="card-img-top" style="width: 16rem; height: 10rem; overflow: hidden;">
    <img class="align-middle" style="width: 15.8rem;" src="<?php echo "/images/items/" . $item["image_ref"] . "_card.jpg" ?>" alt="Card image cap">
  </div>
  <div class="card-body">
    <h5 class="card-title" style="max-height: 48px; overflow: hidden;">
        <?php echo $item["name"] ?>
    </h5>
    <p class="card-subtitle pb-2"><?php echo (string) $item["price"] . " kr" ?></p>
    <a href="/product/details?id=<?php echo $item["id"] ?>" class="btn btn-primary">Visa produkt</a>
  </div>
</div>
