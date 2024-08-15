<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
$videos = db_query("SELECT 
    videos.id,
    videos.title,
    videos.description,
    videos.visibility,
    videos.creator,
    (SELECT username FROM users WHERE id = videos.creator) AS creator_username, CONCAT('$primary_site/v/', videos.id, '/') AS link,
    CONCAT('$primary_site/api/videos/thumbnail.php?v=', videos.id) AS thumbnail,
    CONCAT('$primary_site/api/accounts/getLogo.php?id=', videos.creator) AS logo,
    COALESCE(AVG(ratings.value), 0) AS stars,
    COALESCE(SUM(ratings.value), 0) AS stars_total
FROM videos
LEFT JOIN ratings ON ratings.video = videos.id
GROUP BY videos.id 
ORDER BY videos.creation DESC
LIMIT :count", array("count" => $_GET["count"]))->fetchAll(PDO::FETCH_ASSOC);

$final = [];
foreach($videos as $v) {
    
    if(canShowVideo($v))
        array_push($final, $v);
    
}

echo json_encode($final);

?>