<?php

/** @var object $base **/
/** @var string $activeMenu **/

?>

<aside class="mt-10">
    <nav>
        <a href="<?= $base; ?>">
            <div class="menu-item <?= $activeMenu === 'home' ? 'active' : ''; ?>">
                <div class="menu-item-icon">
                    <img src="<?= $base . "/"; ?>assets/images/home-run.png" width="16" height="16" alt="Home" />
                </div>
                <div class="menu-item-text">
                    Home
                </div>
            </div>
        </a>
        <a href="<?= $base . "/"; ?>perfil.php">
            <div class="menu-item <?= $activeMenu === 'profile' ? 'active' : ''; ?>">
                <div class="menu-item-icon">
                    <img src="<?= $base . "/"; ?>assets/images/user.png" width="16" height="16" alt="Perfil" />
                </div>
                <div class="menu-item-text">
                    Meu Perfil
                </div>
            </div>
        </a>
        <a href="<?= $base . "/"; ?>friends.php">
            <div class="menu-item <?= $activeMenu === 'friends' ? 'active' : ''; ?>">
                <div class="menu-item-icon">
                    <img src="<?= $base . "/"; ?>assets/images/friends.png" width="16" height="16" alt="Amigos" />
                </div>
                <div class="menu-item-text">
                    Amigos
                </div>
                <!--<div class="menu-item-badge">
                    33
                </div>-->
            </div>
        </a>
        <a href="<?= $base . "/"; ?>photos.php">
            <div class="menu-item <?= $activeMenu === 'photos' ? 'active' : ''; ?>">
                <div class="menu-item-icon">
                    <img src="<?= $base . "/"; ?>assets/images/photo.png" width="16" height="16" alt="Fotos" />
                </div>
                <div class="menu-item-text">
                    Fotos
                </div>
            </div>
        </a>
        <div class="menu-splitter"></div>
        <a href="<?= $base . "/"; ?>configs.php">
            <div class="menu-item <?= $activeMenu === 'configs' ? 'active' : ''; ?>">
                <div class="menu-item-icon">
                    <img src="<?= $base . "/"; ?>assets/images/settings.png" width="16" height="16" alt="Configurações" />
                </div>
                <div class="menu-item-text">
                    Configurações
                </div>
            </div>
        </a>
        <a href="<?= $base . "/"; ?>logout.php">
            <div class="menu-item">
                <div class="menu-item-icon">
                    <img src="<?= $base . "/"; ?>assets/images/power.png" width="16" height="16" alt="Sair" />
                </div>
                <div class="menu-item-text">
                    Sair
                </div>
            </div>
        </a>
    </nav>
</aside>