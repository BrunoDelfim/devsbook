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
                <img src="<?=$base."/";?>assets/images/send.png" class="send-arrow-feed"  alt=""/>
            </div>
            <form action="<?=$base."/";?>feed_editor_action.php" method="POST" class="feed-new-form">
                <input type="hidden" name="body"/>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    let feedInput = document.querySelector('.feed-new-input');
    let feedSubmit = document.querySelector('.feed-new-send');
    let feedForm = document.querySelector('.feed-new-form');
    let arrowSendFeed = document.querySelector('.send-arrow-feed');
    let initial_value = feedInput.innerText.trim();

    (function () {
        let value = feedInput.innerText.trim();
        if (initial_value === value) {
            feedSubmit.style.cursor = 'default';
            arrowSendFeed.style.opacity = '0.3';
        }
    })();
    feedInput.addEventListener('input', () => {
        let value = feedInput.innerText.trim();
        if (value !== initial_value) {
            feedSubmit.style.cursor = 'pointer';
            arrowSendFeed.style.transition = 'opacity 0.3s ease-in-out';
            arrowSendFeed.style.opacity = '1';
        } else {
            feedSubmit.style.cursor = 'default';
            arrowSendFeed.style.opacity = '0.3';
        }
    });
    // refatore o código abaixo para usar o método submit() do objeto form
    feedSubmit.addEventListener('click', () => {
        let value = feedInput.innerText.trim();
        if (value === initial_value) {
            feedSubmit.preventDefault();
        } else {
            feedForm.querySelector('input[name=body]').value = value;
            feedForm.submit();
        }
    });
</script>