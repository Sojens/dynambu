<?php


if(!canDisplayVideo($_GET["v"]))
    api_response(API_AUTH_ERROR);

$video =
    db_query(
        "SELECT 
            videos.id,
            videos.title,
            videos.description,
            videos.visibility,
            videos.creator,
            (SELECT username FROM users WHERE id = videos.creator) AS creator_username, CONCAT('$primary_site/v/', videos.id, '/') AS link,
            AVG(ratings.value) AS stars,
            SUM(ratings.value) AS stars_total
        FROM videos 
        LEFT JOIN ratings ON ratings.video = videos.id 
            WHERE videos.id = ?
        GROUP BY videos.id
        ORDER BY stars_total DESC",
        [
            $_GET["v"]
        ]
    )->fetch(PDO::FETCH_ASSOC);

$video["stars"] = round($video["stars"]);
    
echo json_encode($video);
    
    
?>