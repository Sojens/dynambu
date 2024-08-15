<?php

api_require(["user" => "yeah user is required", "count" => "yeah count is required"]);

$videos = db_query("
SELECT 
        videos.id,
        videos.title,
        videos.description,
        videos.visibility,
        videos.creator,
        (SELECT username FROM users WHERE id = videos.creator) AS creator_username, CONCAT('$primary_site/v/', videos.id, '/') AS link,
        CONCAT('$primary_site/api/videos/thumbnail.php?v=', videos.id) AS thumbnail,
        AVG(ratings.value) AS stars,
        SUM(ratings.value) AS stars_total
    FROM videos 
    LEFT JOIN ratings ON ratings.video = videos.id
        WHERE videos.creator = ?
    GROUP BY videos.id
    ORDER BY videos.creation DESC
    LIMIT ?
", [$_GET["user"], (int) $_GET["count"]])->fetchAll(PDO::FETCH_ASSOC);

$final = [];
foreach($videos as $v) {
    
    if(canShowVideo($v))
        array_push($final, $v);
    
}

api_success($final);

?>