<?php

head(l("explore"), ["pagetype" => "full", "description" => l("desc_explore")]);

form_start("/explore/search/", 
    [
        "type" => "normal",
        "method" => "GET",
        "id" => "search"
    ]
);

input(["type" => "text",    "name" => "q",          "placeholder" => l("search")]);

form_end();

div_open();
    
    div_open(["class" => "header text-center"]);
        text(l("popular_users"));
    div_close();
    div_open(["class" => "popularUsers"]);
        
        $popularUsers = db_query("SELECT users.*, COUNT(feed.id) AS feedcount FROM users LEFT JOIN feed ON users.id = feed.following GROUP BY users.id ORDER BY feedcount DESC LIMIT 16")->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($popularUsers as $user) {
            
            showUser($user, null, ["square" => "true"]);
            
        }
        
    div_close();
div_close();

div_open(["class" => "header text-center"]);
    text(l("videos"));
div_close();

div_open(["class" => "flex even VL-in-center"]);
    
    div_open();
        
        div_open(["class" => "header"]);
            text(l("popular_videos"));
        div_close();
        
        div_open(["class" => "w2videos"]);
            $popular = db_query("SELECT videos.*, SUM(ratings.value) AS stars FROM videos LEFT JOIN ratings ON ratings.video = videos.id GROUP BY videos.id ORDER BY stars DESC LIMIT 50")->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($popular as $video) {
                
                if(canShowVideo($video))
                    showVideo($video);
                
            }
        div_close();
    div_close();
    
    div(["class" => 'vertical-line']);
    
    div_open();
        div_open(["class" => "header right"]);
            text(l("latest_videos"));
        div_close();
        
        div_open(["class" => "w2videos"]);
            $latest = db_query("SELECT * FROM videos ORDER BY creation DESC LIMIT 50");
            
            foreach($latest as $video) {
                
                if(canShowVideo($video))
                    showVideo($video);
                
            }
        div_close();
        
    div_close();
    
div_close();



foot();

?>