<?php

/** @var object $base **/
/** @var object $userInfo **/
/** @var string $firstName **/

?>

<div class="box feed-new">
    <div class="box-body">
        <div class="feed-new-editor m-10 row">
            <div class="feed-new-avatar">
                <img src="<?=$base."/";?>media/avatars/<?=$userInfo->avatar;?>"  alt=""/>
            </div>
            <label class="feed-new-input">
                <textarea id="myTextarea" rows="1" type="text" class="feed-new-input-placeholder">O que você está pensando, <?=$firstName;?>?</textarea>
            </label>
            <div class="feed-new-send">
                <input type="image" alt="" src="<?=$base."/";?>assets/images/send.png" class="send-arrow-feed"/>
            </div>
            <form action="<?=$base."/";?>feed_editor_action.php" method="POST" class="feed-new-form">
                <input type="hidden" name="body"/>
            </form>
        </div>
    </div>
</div>