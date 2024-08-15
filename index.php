<?php
/*
head(l("cs"), ["pagetype" => "mini", "centered" => true]);

p(l("home_cs"));

foot();
*/

if($loggedin){
    head(l("home"), ["pagetype" => "full"]);
    
    $subquery = "user = ? AND amount < 0.95 AND amount > 0 ORDER BY amount DESC";
    $currentlyWatching = db_query(
        "SELECT
        videos.*,
        watched.edited AS watch_last_point, 
        watched.id AS watchedID
        FROM watched
        RIGHT JOIN videos ON videos.id = watched.video
        WHERE watched.user = ?
        AND watched.amount < 0.95
        AND watched.amount > 0
        
        ORDER BY watch_last_point DESC
        LIMIT 8", [$userid]);
    
    if($currentlyWatching->rowCount() > 0) {
        
        div_open(["class" => "header text-center"]);
            text(l("continue_watching"));
        div_close();
        
        div_open(["class" => "bigvideos"]);
            foreach($currentlyWatching as $v) {
                if(canShowVideo($v))
                    showVideo($v);
            }
        div_close();
        
    }
    
    
    div_open(["class" => "header text-center"]);
        text(l("unwatched"));
    div_close();
    $videos = getFeed(4*50);

    div_open(["class" => "bigvideos"]);
        foreach($videos as $v) {
            if(canShowVideo($v))
                showVideo($v);
        }
    div_close();

    foot();
} else {
    
    header("Location: /explore/");
    
}


?>