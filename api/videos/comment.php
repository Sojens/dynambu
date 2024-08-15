<?php

api_require_login();

if (api_require([
    "comment" => l("comment_textfield_error"),
    //"replyingTo" => "you must specify what you're replying to, even if you're not replying to anything (value of 0 for no reply)"
]))
{
    
    if(!isset($_GET["v"]))
        api_error(["v" => "idiot didn't even specify a video"]);
    if(!isset($_GET["replyingTo"]) || !($_GET["replyingTo"] === "0" || $_GET["replyingTo"] === 0 || db_query("SELECT * FROM comments WHERE id = ? AND video = ?", [$_GET["replyingTo"], $_GET["v"]])->rowCount() > 0))
        api_error(["replyingTo" => "the comment you're replying to doesn't exist!"]);
    if(strlen($_POST["comment"]) > 1000)
        api_error(["comment" => l("comment_textfield_toolong")]);
    
    db_query("INSERT INTO comments (id, text, replyingTo, video, creator) VALUES (?,?,?,?,?)", [randID(), $_POST["comment"], $_GET["replyingTo"], $_GET["v"], $userid]);
    
    api_success();
} 