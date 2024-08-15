<?php
header("Access-Control-Allow-Origin: *");

if(!isset($_GET["q"]))
    api_error(["q" => "please specifying search query :)"]);
$q = videos_search($_GET["q"])->fetchAll(PDO::FETCH_ASSOC);


$videos = [];
foreach($q as $video) {
    if(canShowVideo($video)) {
        
        $video["stars"] = round($video["stars"])/2;
        
        $videos[] = $video;
    }
}

api_success($videos);

?>