<?php

api_require_login();

if (api_require([
    "rating" => "ya gotta specify a rating value from 1 to 10 (although, this is banned by the ToS... dont rate videos from the api if you can help it)",
    "v" => "ya gotta specify a video to rate (although, man, this is banned by the ToS, so probably dont rate videos from the api pls)"
    //"replyingTo" => "you must specify what you're replying to, even if you're not replying to anything (value of 0 for no reply)"
]))
{
    
    if($_POST['rating'] < 1 || $_POST["rating"] > 10 || (floor((Float) $_POST["rating"]) !== (Float) $_POST["rating"]))
        api_error("invalid rating...");
    
    $video = db_query("SELECT * FROM videos WHERE id = ?", [$_POST["v"]]);
    if($video->rowCount() == 0)
        api_error(["v" => "that video doesn't exist.. what are you trying to do?"]);
    $video = $video->fetch(PDO::FETCH_ASSOC);
    
    if($video["creator"] == $userid)
        api_error(["v" => "you made that video... you can't vote on yourself"]);
    
    if(db_query("SELECT * FROM ratings WHERE creator = ? AND video = ? AND value = ?", [$userid, $video["id"], $_POST["rating"]])->rowCount() > 0)
        api_error(["rating" => "rating not changed"]);
    
    if(db_query("SELECT * FROM ratings WHERE creator = ? AND video = ?", [$userid, $video["id"]])->rowCount() <= 0)
        db_query("INSERT INTO ratings (value, video, creator) VALUES (?,?,?)", [$_POST["rating"], $video["id"], $userid]);
    else
        db_query("UPDATE ratings SET value = ? WHERE video = ? AND creator = ? ", [$_POST["rating"], $video["id"], $userid]);
    
    api_success(["newRatio" => (round(db_query("SELECT AVG(value) AS rating FROM ratings WHERE video = ?", [$video["id"]])->fetch(PDO::FETCH_ASSOC)["rating"]) * 10)]);
    
}


?>