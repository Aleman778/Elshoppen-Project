<!-- DEPENDENCIES: header.php, gravatar.php, mysql.php with allocated $db object -->
<?php
    $sql = "SELECT COMMENTS.*, CUSTOMERS.firstname, CUSTOMERS.lastname, CUSTOMERS.email
            FROM CUSTOMERS JOIN COMMENTS
            WHERE CUSTOMERS.id=COMMENTS.customer_id AND COMMENTS.product_id=:id AND
                  COMMENTS.reply_id=0 ORDER BY COMMENTS.id DESC LIMIT 10";
    $stmt = $db->prepare($sql);
    $stmt->execute(array("id" => $_GET["id"]));
    $comments = $stmt->fetchAll();
?>

<div class="container">
    <?php if (count($comments) == 0) { ?>
        <h4 class="mt-3">Inga kommentarer</h4>
    <?php } else { ?>
        <h4 class="mt-3"><?php echo count($comments); ?> kommentarer</h4>
    <?php }?>
    <!-- Add a new comment -->
    <div class="container">
        <?php if ($loggedIn) { ?>
            <div class="row">
                <img src="<?php echo get_gravatar($email, 38); ?>" class="rounded-circle m-2" width="38" height="38" style="margin-top:5px;">
                <div class="col-lg form-group">
                    <textarea style="resize: none;" class="form-control" id="comment" product="<?php echo $_GET["id"]; ?>" rows="1" maxlength="200" placeholder="Lägg till en kommentar..."></textarea>
                </div>
            </div>
            <div style="min-height: 48px; max-height: 48px; min-width=100%;">
                <button class="btn btn-primary float-right" id="comment-btn" type="button" disabled>Kommentera</button>
            </div>
        <?php } else { ?>
            <h5>Du måste vara inloggad för att skriva kommentarer.</h5>
        <?php } ?>
    </div>
    <?php foreach ($comments as $comment) { ?>
        <div id="comment-div-<?php echo $comment["id"]; ?>" class="container mb-4">
            <div class="row">
                <img src="<?php echo get_gravatar($comment["email"], 38); ?>" class="rounded-circle m-2" width="38" height="38" style="margin-top:5px;">
                <div class="col-lg mb-2">
                    <b><?php echo $comment["firstname"] . " " . $comment["lastname"]; ?></b>
                    <p class="mb-1"><?php echo $comment["comment"]; ?></p>
                    <button style="height: 28px; padding-top: 0px;" class="btn btn-light toggle-btn" id="write-reply-btn-<?php echo $comment["id"]; ?>" target="write-reply-div-<?php echo $comment["id"]?>" data-toggle="button" aria-pressed="false" autocomplete="off">Svara</button>
                </div>
            </div>
            <div class="container" style="margin-left: 32px;">
                <div id="write-reply-div-<?php echo $comment["id"]; ?>" class="container write-reply-div">
                    <div class="row">
                        <img src="<?php echo get_gravatar($comment["email"], 38); ?>" class="rounded-circle m-2" width="24" height="24" style="margin-top:5px;">
                        <div class="col-lg form-group">
                            <textarea style="resize: none; height:38px;" class="form-control reply" id="reply-<?php echo $comment["id"]?>" target="reply-btn-<?php echo $comment["id"] ?>" rows="1" maxlength="200" placeholder="Lägg till ett svar..."></textarea>
                        </div>
                    </div>
                    <div style="min-height: 48px; max-height: 48px; min-width=100%;">
                        <button class="btn btn-primary float-right" id="reply-btn-<?php echo $comment["id"] ?>" type="button" disabled>Svara</button>
                        <button class="btn btn-light mr-2 float-right" id="cancel-btn-<?php echo $comment["id"] ?>" type="button">Avbryt</button>
                    </div>
                </div>
                <button style="height: 28px; padding-top: 0px;" class="btn btn-light toggle-btn" id="show-reply-btn" target="reply-div-<?php echo $comment["id"]?>" data-toggle="button" aria-pressed="false" autocomplete="off">Visa svar</button>
                <?php
                    $sql = "SELECT COMMENTS.id, COMMENTS.comment, CUSTOMERS.firstname, CUSTOMERS.lastname, CUSTOMERS.email
                            FROM CUSTOMERS JOIN COMMENTS
                            WHERE COMMENTS.product_id=:id AND COMMENTS.reply_id=".$comment["id"]." 
                            ORDER BY COMMENTS.id DESC LIMIT 10";
                    $stmt = $db->prepare($sql);
                    $stmt->execute(array("id" => $comment["id"]));
                    $replies = $stmt->fetchAll();
                ?>
                <?php foreach ($replies as $reply) { ?>
                    <div id="reply-div-<?php echo $reply["id"]; ?>" class="reply-div">
                        <div id="comment-<?php echo $comment["id"]; ?>" class="container">
                            <div class="row">
                                <img src="<?php echo get_gravatar($reply["email"], 38); ?>" class="rounded-circle m-2" width="38" height="38" style="margin-top:5px;">
                                <div class="col-lg mb-2">
                                    <b><?php echo $reply["firstname"] . " " . $reply["lastname"]; ?></b>
                                    <p class="mb-1"><?php echo $reply["comment"]; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>
