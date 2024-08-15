<?php

api_require_login();

if(isset($_POST["uid"]) ) {
    
    if($_POST["uid"] === $userid)
        api_error(["uid" => "user id can't be the same as yourself, that's cheating!"]);
    if(db_query("SELECT * FROM users WHERE id = ?", [$_POST["uid"]])->rowCount() == 0)
        api_error(["uid" => "user doesn't exist"]);
    
    $isInFeed = db_query("SELECT * FROM feed WHERE user = ? AND following = ?", [$userid, $_POST["uid"]])->rowCount() > 0;
    
    if($isInFeed)
        db_query("DELETE FROM feed WHERE user = ? AND following = ?", [$userid, $_POST["uid"]]);
    else
        db_query("INSERT INTO feed (user, following) VALUES (?,?)", [$userid, $_POST["uid"]]);
    
    api_success();
    
} else {
    
    api_error(["genericError" => "you're doing nothing"]);
    
}


?>