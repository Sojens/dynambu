<?php

$video = db_query("SELECT * FROM videos WHERE id = ?", [$_GET["v"]]);

function failureShowing(){
    
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/etc/main.css?t=<?= time() ?>" />
        <link rel="stylesheet" href="/etc/fonts/fonts.css">
        <script src="/etc/lang.js?t=<?= time() ?>"></script>
        <script src="/etc/solar.js?t=<?= time() ?>" defer></script>
        <script src="/etc/libraries.js?t=<?= time() ?>" defer></script>
        <title>Embed Failure - <?= $sitename ?></title>
    </head>
    <body style="background:black;">
        <div style="position:fixed;left:50vw;top:50vh;transform:translate(-50%,-50%);background:black;color:white;font-size:16px;"><?= htmlspecialchars(l("could_not_find", $_GET["v"])) ?></div>
    </body>
</html> 
    <?php
    
    die();
}

if($video->rowCount() == 0)
    failureShowing();
$video = $video->fetch(PDO::FETCH_ASSOC);
if(!canDisplayVideo($video))
    failureShowing();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Embedded Video - <?= $sitename ?></title>
        <link rel="stylesheet" href="/etc/main.css?t=<?= time() ?>" />
        <link rel="stylesheet" href="/etc/fonts/fonts.css">
        <script src="/etc/lang.js?t=<?= time() ?>"></script>
        <script src="/etc/solar.js?t=<?= time() ?>" defer></script>
        <script src="/etc/libraries.js?t=<?= time() ?>" defer></script>
        <style>
            
            body {
                
                background: black;
                
            }
            
            .videobox {
                
                width: 100vw;
                height: 100vh;
                aspect-ratio: unset;
                
            }
            
        </style>
    </head>
    <body>
        <?php
            
            showPlayer($_GET["v"]);
            
        ?>
    </body>
</html>
<?php





?>