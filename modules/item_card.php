<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="<?php echo "/images/items/" . $item["image_ref"] . "_card.jpg" ?>" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title"><?php echo $item["name"] ?></h5>
    <p class="card-subtitle pb-2"><?php echo (string) $item["price"] . " kr" ?></p>
    <a href="#" class="btn btn-primary">Visa produkt</a>
  </div>
</div>