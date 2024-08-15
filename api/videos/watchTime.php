<?php

api_require_login();
if(api_require([
    "video" => "video not specified; why are you using the API for this? you don't have to..  there's no point",
    "watchTime" => "no watch time has been specified; seriously, why are you trying to use the API for this?"
])) {
    
    $v = db_query("SELECT * FROM videos WHERE id = ?", [$_POST["video"]]);
    
    if($v->rowCount() == 0)
        api_error(["video" => "video doesn't exist!"]);
    
    $v = $v->fetch(PDO::FETCH_ASSOC);
    
    if($_POST["watchTime" < 0])
        api_error(["watchTime" => "watch time too low; float 0.00 - 1.00"]);
    
    if($_POST["watchTime" > 1])
        api_error(["watchTime" => "watch time too high; float 0.00 - 1.00"]);
    
    if(db_query("SELECT * FROM watched WHERE user = ? AND video = ?", [$userid, $v["id"]])->rowCount() <= 0)
        db_query("INSERT INTO watched (user, video, amount) VALUES (?,?,?)", [$userid, $v["id"], $_POST["watchTime"]]);
    else
        db_query("UPDATE watched SET amount = ? WHERE video = ? AND user = ? ", [$_POST["watchTime"], $v["id"], $userid]);
    
    api_success();
    
}

?>