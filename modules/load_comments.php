<?php
    $prev_id = 4294967295;
    $product_id = 0;
    $reply_id = 0;

    if (array_key_exists("id", $_GET))
        $product_id = $_GET["id"];
    else if (array_key_exists("product_id", $_POST))
        $product_id = $_POST["product_id"];
    if (array_key_exists("prev_id", $_POST))
        $prev_id = $_POST["prev_id"];
    if (array_key_exists("reply_id", $_POST))
        $reply_id = $_POST["reply_id"];

    if (!isset($db)) {
        $loggedIn = false;
        if (session_status() == PHP_SESSION_NONE)
            session_start();
        if (array_key_exists("customer_id", $_SESSION))
            $loggedIn = true;
        if (array_key_exists("email", $_SESSION))
            $email = $_SESSION["email"];
            
        include("mysql.php");
        include("gravatar.php");
        $db = new MySQL();
    }
    // Preperation for: Select all replies to this comment
    $sql = "SELECT COMMENTS.*, CUSTOMERS.firstname, CUSTOMERS.lastname, CUSTOMERS.email
            FROM CUSTOMERS JOIN COMMENTS
            WHERE CUSTOMERS.id=COMMENTS.customer_id AND COMMENTS.product_id=:pid AND
                  COMMENTS.reply_id=:rid AND COMMENTS.id<:previd
            ORDER BY COMMENTS.id DESC LIMIT 10";
    $stmt = $db->prepare($sql);
    $stmt->execute(array("pid" => $product_id,
                         "rid" => $reply_id,
                         "previd" => $prev_id));
    $comments = $stmt->fetchAll();
?>
<?php foreach ($comments as $comment) { ?>
    <div id="comment-div-<?php echo $comment["id"]; ?>" comment="<?php echo $comment["id"]; ?>" class="mb-3">
        <!-- Select all replies to this comment -->
        <?php
            $commentID = $comment["id"];
            $sql = "SELECT COMMENTS.id, COMMENTS.reply_id, COMMENTS.comment, CUSTOMERS.firstname, CUSTOMERS.lastname, CUSTOMERS.email
                    FROM CUSTOMERS JOIN COMMENTS
                    WHERE CUSTOMERS.id=COMMENTS.customer_id AND COMMENTS.product_id=:id AND
                            COMMENTS.reply_id=$commentID
                    ORDER BY COMMENTS.id DESC LIMIT 10";
            $stmt = $db->prepare($sql);
            $stmt->execute(array("id" => $product_id));
            $replies = $stmt->fetchAll();

            include("comment.php");
        ?>
        <!-- Count the number of replies to this specific comment -->
        <?php 
            $sql = "SELECT COUNT(*) FROM COMMENTS WHERE product_id=:id AND reply_id=$commentID";
            $stmt = $db->prepare($sql);
            $stmt->execute(array("id" => $product_id));
            $numReplies = $stmt->fetch()["COUNT(*)"];
        ?>

        <div class="container" style="margin-left: 55px;">
            <span class="show-reply-btn noselect" style="cursor: pointer; <?php  if ($numReplies == 0) echo "display: none;" ?>">
                Visa <?php if ($numReplies > 1) { echo $numReplies; } ?> svar<img src="/images/icons/arrow_down.png">
            </span>
            <span class="hide-reply-btn noselect" style="cursor: pointer; display: none;">
                Dölj svar<img src="/images/icons/arrow_up.png">
            </span>
            <div id="replies-<?php echo $commentID; ?>" class="replies-div mt-2" style="display: none;">
                <?php
                    foreach ($replies as $comment) {
                        include("comment.php");
                    }
                    ?>
            </div>
        </div>
    </div>
<?php } ?>