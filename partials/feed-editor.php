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
            <div class="feed-new-input-placeholder">O que você está pensando, <?=$firstName;?>?</div>
            <div class="feed-new-input" contenteditable="true"></div>
            <div class="feed-new-send">
                <img src="<?=$base."/";?>assets/images/send.png"  alt=""/>
            </div>
            <form action="<?=$base."/";?>feed_editor_action.php" method="POST" class="feed-new-form">
                <input type="hidden" name="body" />
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    let feedInput = document.querySelector('.feed-new-input');
    let feedSubmit = document.querySelector('.feed-new-send');
    let feedForm = document.querySelector('.feed-new-form');
    feedSubmit.addEventListener('click', () => {
        feedForm.querySelector('input[name=body]').value = feedInput.innerText.trim();
        feedForm.submit();
    });
</script>