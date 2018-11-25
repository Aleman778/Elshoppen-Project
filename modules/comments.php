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
        <?php
            $sql = "SELECT COMMENTS.id, COMMENTS.comment, CUSTOMERS.firstname, CUSTOMERS.lastname, CUSTOMERS.email
                    FROM CUSTOMERS JOIN COMMENTS
                    WHERE COMMENTS.product_id=:id AND COMMENTS.reply_id=".$comment["id"]." 
                    ORDER BY COMMENTS.id DESC LIMIT 10";
            $stmt = $db->prepare($sql);
            $stmt->execute(array("id" => $_GET["id"]));
            $replies = $stmt->fetchAll();
        ?>
        
        <div id="comment-div-<?php echo $comment["id"]; ?>" class="container mb-2">
            <div class="row">
                <img src="<?php echo get_gravatar($comment["email"], 38); ?>" class="rounded-circle m-2" width="38" height="38" style="margin-top:5px;">
                <div class="col-lg mb-2">
                    <b><?php echo $comment["firstname"] . " " . $comment["lastname"]; ?></b>
                    <p class="mb-1"><?php echo $comment["comment"]; ?></p>
                    <?php if ($loggedIn) { ?>
                        <button style="height: 28px; padding-top: 0px;" class="btn btn-light toggle-btn" id="write-reply-btn-<?php echo $comment["id"]; ?>" target="write-reply-div-<?php echo $comment["id"]?>" data-toggle="button" aria-pressed="false" autocomplete="off">Svara</button>
                    <?php } ?>
                    <?php $rcount = count($replies); if ($rcount > 0) { ?>
                        <span class="show-reply-btn toggle-btn" style="cursor: pointer" target="reply-div-<?php echo $comment["id"]?>">
                            Visa <?php if ($rcount > 1) { echo $rcount; } ?> svar<img src="/images/icons/arrow_down.png">
                        </span>
                        <span class="hide-reply-btn toggle-btn" style="cursor: pointer" target="reply-div-<?php echo $comment["id"]?>">
                            Dölj svar<img src="/images/icons/arrow_up.png">
                        </span>
                    <?php } ?>
                </div>
            </div>
            <div class="container" style="margin-left: 32px;">
                <?php if ($loggedIn) { ?>
                    <div id="write-reply-div-<?php echo $comment["id"]; ?>" class="container write-reply-div">
                        <div class="row">
                            <img src="<?php echo get_gravatar($email, 38); ?>" class="rounded-circle m-2" width="24" height="24" style="margin-top:5px;">
                            <div class="col-lg form-group">
                                <div class="row">
                                    <div class="col-lg message">
                                        <textarea style="resize: none; height:38px;" class="form-control reply" id="reply-<?php echo $comment["id"]?>" target="reply-btn-<?php echo $comment["id"] ?>" rows="1" maxlength="200" placeholder="Lägg till ett svar..."></textarea>
                                    </div>
                                    <button class="btn btn-light mr-2 cancel-reply-btn" id="cancel-btn-<?php echo $comment["id"] ?>" divref="write-reply-div-<?php echo $comment["id"]; ?>" target="reply-<?php echo $comment["id"]?>" type="button">Avbryt</button>
                                    <button class="btn btn-primary reply-btn" id="reply-btn-<?php echo $comment["id"] ?>" to="<?php echo $comment["id"]?>" type="button" disabled>Svara</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php var_dump($replies); ?>
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
