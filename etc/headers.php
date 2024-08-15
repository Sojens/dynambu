<?php

function head($title, $settings) {
    
    global $loggedin, $username, $selected_language, $languages, $userdata, $sitename;
    $pagetype = $settings["pagetype"];
    global $path;
    
    ?>
<!DOCTYPE html>
<html lang="en" class="<?= $loggedin ? "logged-in" : "" ?>">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/etc/main.css?t=<?= time() ?>">
        <link rel="stylesheet" href="/etc/fonts/fonts.css">
        <link rel="prefetch" href="/img/branding/dynambu_logo_icon.svg">
	<link rel="icon" href="/img/branding/dynambu_logo_icon.svg" type="image/x-icon">
	<script src="/api/socko/socket.io/socket.io.js" defer></script>
        <script src="/etc/lang.js?t=<?= time() ?>"></script>
        <script src="/etc/solar.js?t=<?= time() ?>" defer></script>
        <script src="/etc/libraries.js?t=<?= time() ?>" defer></script>
	<script src="/etc/handle_forms.js?t=<?= time() ?>" defer></script>
        <title><?= htmlspecialchars($title) ?> - <?= $sitename ?></title>
        <meta name="title" content="<?= htmlspecialchars($title, ENT_QUOTES) ?>">
        <meta name="description" content="<?= htmlspecialchars(isset($settings["description"]) ? $settings["description"] : l("desc_default"), ENT_QUOTES) ?>">
        <meta property="theme-color" content="#1c2c3e" />
        <meta property="og:title"       content="<?= htmlspecialchars($title, ENT_QUOTES) ?>">
        <meta property="og:description" content="<?= htmlspecialchars(isset($settings["description"]) ? $settings["description"] : l("desc_default"), ENT_QUOTES) ?>">
        <?php if($settings["video"]) { ?>
        
        <meta property="og:type" content="video">
        <meta property="og:video" content="<?= htmlspecialchars($settings["video"], ENT_QUOTES) ?>">
        <meta property="og:video:type" content="video/mp4">
        
        <?php } ?>
        
    </head>
    <body class="dark">
        
        <div id="db_fullscreen_overlay"></div>
        <div id="db_modal">
            <img src="/img/branding/dynambu_logo_icon.svg">
            <h1></h1>
            <span></span>
            <div id="db_modal_buttons">
                <button></button>
            </div>
        </div>
        <div id="header">
            <object data="/img/branding/dynambu_logo_full-white.svg" style="height: 100%;"></object>
            <div id="hamburger-icon" onclick="this.parentElement.classList.toggle('menu-open')"></div>
            <div id="mobile-menu">
                <a href="/"><?= l("home") ?></a>
                <a href="/explore/"><?= l("explore") ?></a>
                <a href="/upload/"><?= l("vidUpload") ?></a>
            </div>
            <div>
                <select id="language_select" onchange="document.cookie = 'language='+this.value+'; expires=Thu, 18 Dec 2025 12:00:00 UTC; path=/; SameSite=None; Secure'; window.location.reload();" >
                    
                    <?php
                    
                    foreach($languages as $lng => $lngname) {
                        
                        ?>
                        
                        <option value="<?= htmlspecialchars($lng, ENT_QUOTES) ?>" <?= $lng == $selected_language ? "selected" : "" ?>><?= htmlspecialchars($lngname); ?></option>
                        
                        <?php
                        
                    }
                    
                    ?>
                    
                </select>
                <?php if(!$loggedin) { ?>
                <a href="/account/create/"><?= l("createAcc") ?></a>
                <a href="/account/login/"><?= l("login") ?></a>
                <?php } else { ?>
                <div id="user-menu" onclick="this.classList.toggle('visible');document.querySelector('#umenu-screen-cover').classList.toggle('visible')">
                    <div id="umenu-header"><?= htmlspecialchars($username); ?></div>
                    <div id="umenu">
                        <a href="/u/<?= htmlspecialchars(strtolower($username), ENT_QUOTES) ?>/"><?= l("profile") ?></a>
                        <a href="/account/videos/"><?= l("myvideos") ?></a>
                        <a href="/account/"><?= l("settings") ?></a>
                        <?php
                        
                        if($userdata["class"] == "ADMINISTRATOR") {
                            ?><a href="/administration/reports/" style="color: red;">Reports</a><?php
                        }
                        
                        ?>
                        <a href="/logout/"><?= l("logout") ?></a>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <div id="umenu-screen-cover" onclick="this.classList.remove('visible');this.parentElement.querySelector('#user-menu').classList.remove('visible')">
        </div>
        <div id="content" class="<?= $pagetype ?> <?= isset($settings["centered"]) && $settings["centered"] == true ? "centered" : "" ?>">
            <?php
            if($pagetype == "mini" || $pagetype == "tiny") {
                ?><h1><?= htmlspecialchars($title) ?></h1><?php
            }
            ?>
<?php
    
}
function foot() {
    
    ?>
        
        </div>
    </body>
</html>
<?php
    
}

?>
