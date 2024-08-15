<?php

api_require_login();
$videos = getFeed((int) $_GET["count"]);

$final = [];
foreach($videos as $v) {
    
    if(canShowVideo($v))
        array_push($final, $v);
    
}

api_success($final);

?>