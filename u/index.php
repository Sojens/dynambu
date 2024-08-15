<?php

$user = db_query("SELECT * FROM users WHERE username = ?", [$_GET["u"]]);

if($user->rowCount() == 0)
    pagenotfound();

$user = $user->fetch(PDO::FETCH_ASSOC);

head(l("profile"), ["pagetype" => "full", "description" => l("desc_profile")]);
showUser($user, null, ["showFeedButton" => true]);

if($user["blocked"] !== null) {
    
    
    div_open(["style" => "font-style: italic; color: red; white-space: pre; margin-bottom: 30px;"]);
        text("The user \"".$user["username"]."\" has been blocked. ");
        if($loggedin && $userdata["class"] == "ADMINISTRATOR")
            a(["href" => "/administration/actions/user/?unblock&id=".$user["id"], "text" => "Unblock", "style" => "font-style: normal;"]);
        text("\nReason: \n\n");
        div_open(["style" => "font-family: monospace; color: white; font-style: normal;"]);
            text($user["blocked-public"]);
        div_close();
    div_close();
    
    
}

if(strlen($user["bio"]) > 0) {
    div_open(["id" => "video-description"]);
        text($user["bio"]);
    div_close();
}

$videos = db_query("SELECT * FROM videos WHERE creator = ? ORDER BY creation DESC", [$user['id']])->fetchAll(PDO::FETCH_ASSOC);

div_open(["class" => "bigvideos"]);
    foreach($videos as $v) {
        if(canShowVideo($v))
            showVideo($v);
    }
div_close();

foot();

?>