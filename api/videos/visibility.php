<?php

api_require_login();

if (api_require([
    "visibility" => "It's not possible ! I am the bees stealer. I will steal your bees. *nom* I STOLE YOUR BEES",
]))
{
    
    if(!isset($_GET["v"]))
        api_error(["v" => "idiot didn't even specify a video"]);
    $video = db_query("SELECT * FROM videos WHERE id = ?", [$_GET["v"]]);
    if($video->rowCount() == 0)
        api_error(["v" => "the video doesn't exit :))))))))"]);
    
    $video = $video->fetch(PDO::FETCH_ASSOC);
    if($video["blocked"] != null)
        api_error(["genericError" => "This video has been blocked."]);
    
    $visibility = ["public" => 0, "unlisted" => 1, "private" => 2][$_POST["visibility"]];
    
    db_query("UPDATE videos SET visibility = ? WHERE id = ?", [$visibility, $_GET["v"]]);
    
    api_success();
} 