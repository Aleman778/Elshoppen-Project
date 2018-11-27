<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];

    session_start();
    if (!(array_key_exists("customer_id", $_SESSION))) {
        header("Location: /account/signin");
    }
    include("$root/modules/mysql.php");

    $customer_id = $_SESSION["customer_id"];

    $db = new MySQL();
    $sql = "SELECT C.product_id , C.quantity, 
            P.id, P.name, P.description, P.price, P.image_ref
            FROM CART C
            INNER JOIN PRODUCTS P ON C.product_id = P.id
            WHERE C.customer_id LIKE $customer_id";
    $items =  $db->fetchAll($sql);
?>

<!DOCTYPE html>
<html>
    <head>
    <title>Din Kundvagn - Elshoppen</title>
    <!-- Include basic libraries -->
    <?php include("$root/modules/bootstrap_css.php"); ?>
    </head>
    <body>
    <?php include("$root/header.php"); ?>
    <div id="main" class="container">
        <?php if (count($items) > 0) { ?>
            <div class="w-100 pt-2 pl-3" id="cart-header" style="background-color: rgb(242, 242, 242); border: 1px solid #dee2e6; border-top-left-radius: .25rem;  border-top-right-radius: .25rem;">
                <h4>Din Kundvagn</h4>
            </div>
            <div class="container" id="cart" style="border: 1px solid #dee2e6; border-top: none; border-top-left-radius: 0px; border-bottom-left-radius: .25rem;  border-bottom-right-radius: .25rem;">
                <table class="table">
                    <thead class="thead">
                        <tr>
                            <th scope="col" style="border: none;">Produkt</th>
                            <th scope="col" style="border: none; text-align: center;">Styckpris</th>
                            <th scope="col" style="border: none; text-align: center;">Antal</th>
                            <th scope="col" style="border: none;"></th>
                            <th scope="col" style="border: none; text-align: center;">Summa</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($items as $item) { ?>
                        <?php
                            $images = explode(",", $item["image_ref"]);
                        ?>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-sm" style="max-width: 12rem; height: 8rem; overflow: hidden; text-align:center">
                                        <img src="<?php echo "/images/items/$images[0]/$images[1]"; ?>" style="height: 8rem;">
                                    </div>
                                    <div class="col-md">
                                        <h5 class="mb-1"><?php echo $item["name"]; ?></h5>
                                        <p><?php echo $item["description"] ?></p>
                                    </div>
                                </div>
                            </td>
                            <td style="text-align: center; padding-top:19px;" class="price">
                                <?php echo $item["price"] ?> kr
                            </td>
                            <td style="min-width: 178px; max-width: 178px;">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-light btn-decr p-1" pid="<?php echo $item["id"]; ?>" style="border: 1px solid #ced4da;" type="button">
                                            <img src="/images/icons/remove.svg">
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-spinner" pid="<?php echo $item["id"]; ?>" style="max-width: 86px; min-width: 86px; text-align: center;" price="<?php echo $item["price"]; ?>" value="<?php echo $item["quantity"] ?>">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-light btn-incr p-1" pid="<?php echo $item["id"]; ?>" style="border: 1px solid #ced4da;" type="button">
                                            <img src="/images/icons/add.svg">
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <button class="btn btn-outline-danger btn-delete pt-1 px-2" pid="<?php echo $item["id"]; ?>" style="padding-bottom: .35rem" type="button">
                                    <img src="/images/icons/delete.svg">
                                </button> 
                            </td>
                            <td style="text-align: center; padding-top:19px; border-left: 1px solid #dee2e6;" class="sum">
                                <?php echo $item["quantity"]*$item["price"]; ?> kr
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="text-align: left;">inkl. 25% moms</td>
                        <td></td>
                        <td style="text-align: center;" id="vat"></b></td>
                    </tr>
                    <tr>
                        <td class="py-0" style="border: none;"></td>
                        <td class="py-0" style="border: none;"></td>
                        <td class="py-0" style="border: none; text-align: left;"><h5><b>Att betala</b></h5></td>
                        <td class="py-0" style="border: none;"></td>
                        <td class="py-0" style="border: none; text-align: center;" id="total-price"><b></b></td>
                    </tr>
                </table>
            </div>
        <?php } ?>
        <div id="empty-cart" <?php if (count($items) > 0) echo "style='display: none;'"; ?>>
            <h4>Din kundvagn är tom</h4>
            <p>Det finns inga varor i din kundvagn.</p>
        </div>
        <?php if (count($items) > 0) { ?>
            <div class="container pl-0 mt-3 mb-5" id="order-btn">
                <a href="/account/cart/payinfo.php" class="btn btn-primary">Beställ</a>
            </div>
        <?php } ?>
    </div>

    <?php include("$root/footer.php"); ?>

    <!-- Include jQuery, popper and bootstrap  -->
    <?php include("$root/modules/bootstrap_js.php"); ?>

    <!-- fix footer position -->
    <script src="/footer.js"></script>

    <!-- scripting the spinner UI -->
    <script>
        $(document).ready(function() {
            recalculatePrice();
            fixFooter();
        });

        $(".btn-incr").click(function() {
            var parent = $(this).parents(".input-group");
            var decrbtn = parent.children(".input-group-prepend").children(".btn-decr");
            var spinner = parent.children(".form-spinner");
            var sum = parent.parent().siblings(".sum");
            var price = spinner.attr("price");
            var value = spinner.val();
            value++;
            if (value <= 50) {
                spinner.val(value);
                decrbtn.removeAttr("disabled");
                sum.html(value * price + " kr");
                recalculatePrice();
                updateCartTable($(this).attr("pid"), "set", value);
            }
            if (value == 50) {
                $(this).attr("disabled", "disabled");
            }
        });
        
        $(".btn-decr").click(function() {
            var parent = $(this).parents(".input-group");
            var incrbtn = parent.children(".input-group-append").children(".btn-incr");
            var spinner = parent.children(".form-spinner");
            var sum = parent.parent().siblings(".sum");
            var price = spinner.attr("price");
            var value = spinner.val();
            value--;
            if (value > 0) {
                spinner.val(value);
                incrbtn.removeAttr("disabled");
                sum.html(value * price + " kr");
                recalculatePrice();
                updateCartTable($(this).attr("pid"), "set", value);
            }
            if (value == 1) {
                $(this).attr("disabled", "disabled");
            }
        });

        $(".form-spinner").keyup(function() {
            if ($(this).val() == "")
                return;

            var sum = $(this).parents("td").siblings(".sum");
            var price = $(this).attr("price");
            var value = parseInt($(this).val());

            $(".btn-incr").removeAttr("disabled");
            $(".btn-decr").removeAttr("disabled");
            if (isNaN(value)) {
                value = 1;
            }
            if (value <= 1) {
                value = 1;
                $(".btn-decr").attr("disabled", "disabled");
            }
            if (value >= 50) {
                value = 50;
                $(".btn-incr").attr("disabled", "disabled");
            }
            $(this).val(value);
            sum.html(value * price + " kr");
            recalculatePrice();
            updateCartTable($(this).attr("pid"), "set", value);
        });

        $(".form-spinner").focusout(function() {
            if ($(this).val() == "") {
                $(this).val(1);
                $(".btn-decr").attr("disabled", "disabled");
                var sum = $(this).parents("td").siblings(".sum");
                sum.html($(this).attr("price") + " kr");
                recalculatePrice();
                updateCartTable($(this).attr("pid"), "set", 1);
            }
        });

        $(".btn-delete").click(function() {
            $(this).parents("tr").remove();
            recalculatePrice();

            if ($(".form-spinner").length == 0) {
                $("#cart").hide();
                $("#cart-header").hide();
                $("#order-btn").hide();
                $("#empty-cart").show();
            }
            
            fixFooter();
            updateCartTable($(this).attr("pid"), "delete", "");
        });

        function recalculatePrice() {
            var price = 0;
            $(".form-spinner").each(function() {
                price += $(this).attr("price") * $(this).val();
            });
            $("#vat").html(Math.round(price * 0.25) + " kr");
            $("#total-price").html(price + " kr");
        }

        function updateCartTable(product, action, argument) {
            $.ajax({
                method: "GET",
                url: "update_cart.php",
                data: {
                    id: product,
                    action: action,
                    arg: argument
                }
            });
        }

    </script>

    </body>
</html>
