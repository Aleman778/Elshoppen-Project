<div id="<?php echo $comment["id"]; ?>" class="container <?php if ($comment["reply_id"] == 0) echo "comment"; else echo "reply"; ?>">
    <div class="row">
        <img src="<?php echo get_gravatar($comment["email"], 38); ?>" class="rounded-circle m-2" width="38" height="38" style="margin-top:5px;">
        <div class="col-lg">
            <b><?php echo $comment["firstname"] . " " . $comment["lastname"]; ?></b>
            <p class="mb-1"><?php echo $comment["comment"]; ?></p>
            <?php if ($loggedIn) { ?>
                <button style="height: 28px; padding-top: 0px;" class="btn btn-light reply-btn">Svara</button>
                <div id="write-reply-div-<?php echo $comment["id"]; ?>" class="container mt-2 write-reply-div" style="display: none;">
                    <div class="row">
                        <img src="<?php echo get_gravatar($email, 38); ?>" class="rounded-circle m-2" width="24" height="24" style="margin-top:5px;">
                        <div class="col-lg form-group">
                            <div class="row">
                                <div class="col-lg message">
                                    <textarea style="resize: none; height:38px;" class="form-control reply-msg" id="reply-<?php echo $comment["id"]?>" target="reply-btn-<?php echo $comment["id"] ?>" rows="1" maxlength="200" placeholder="Lägg till ett svar..."></textarea>
                                </div>
                                <button class="btn btn-light cancel-reply-btn mr-2" id="cancel-btn-<?php echo $comment["id"] ?>" type="button">Avbryt</button>
                                <button class="btn btn-primary send-reply-btn" id="reply-btn-<?php echo $comment["id"] ?>" to="<?php echo $commentID; ?>" type="button" disabled>Svara</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>