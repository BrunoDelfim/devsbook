<?php

require 'config.php';
require 'models/Auth.php';
require 'dao/PostDaoMysql.php';

/** @var object $pdo **/
/** @var object $base **/

$auth       = new Auth($pdo, $base);
$userInfo   = $auth->checkToken();
$activeMenu = 'home';

$postDao = new PostDaoMysql($pdo);
$feed = $postDao->getHomeFeed($userInfo->id);
//echo '<pre>';
//print_r($feed);
//exit;

require 'partials/header.php';
require 'partials/menu.php';

?>

<section class="feed mt-10">
    <div class="row">
        <div class="column pr-5">
            <?php require 'partials/feed-editor.php'; ?>
            <?php
                if ($feed) {
                    foreach ($feed as $item) {
                        require 'partials/feed-item.php';
                    }
                }
            ?>
        </div>
        <div class="column side pl-5">
            <div class="box banners">
                <div class="box-header">
                    <div class="box-header-text">Patrocínios</div>
                    <div class="box-header-buttons">

                    </div>
                </div>
                <div class="box-body">
                    <a href=""><img src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__480.jpg"
                            alt="" /></a>
                    <a href=""><img src="https://cdn.pixabay.com/photo/2016/12/27/21/03/lone-tree-1934897__480.jpg"
                            alt="" /></a>
                </div>
            </div>
            <div class="box">
                <div class="box-body m-10">
                    Criado com ❤️ por Bruno Delfim
                </div>
            </div>
        </div>
    </div>
</section>

<?php require 'partials/footer.php' ?>