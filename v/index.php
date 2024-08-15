<?php

$video = db_query("SELECT * FROM videos WHERE id = ?", [$_GET["v"]]);

if($video->rowCount() == 0)
    pagenotfound();
$video = $video->fetch(PDO::FETCH_ASSOC);
if(!canDisplayVideo($video))
    pagenotfound();


head($video["title"], ["pagetype" => "full", "video" => "/api/videos/watch.php?v=".$video["id"], "description" => l("desc_video")]);
showPlayer($_GET["v"]);
div_open(["id" => "video-title", "class" => "flex".(!canShowVideo($video) ? " unlisted" : "")]);
    div_open();
        text($video["title"]);
    div_close();
    a(["href" => "/administration/reports/report/?content=".$video["id"]."&type=VIDEO", "class" => "report_button"]);
    div_open(["class" => "star-rating", "style" => "--ratio: ".(round(db_query("SELECT AVG(value) AS rating FROM ratings WHERE video = ?", [$video["id"]])->fetch(PDO::FETCH_ASSOC)["rating"]) * 10)."%;", "video" => $_GET["v"]]);
        div(["class" => "filled-stars"]);
        div(["class" => "unfilled-stars"]);
        if($loggedin && $video["creator"] !== $userid) {
            div(["class" => "user-select-stars", "style" => "--ratio: ".(db_query("SELECT value AS rating FROM ratings WHERE video = ? AND creator = ?", [$video["id"], $userid])->fetch(PDO::FETCH_ASSOC)["rating"] * 10)."%"]);
            for($i = 0.1; $i < 1; $i+=0.1)
                div(["class" => "user-hover-stars-clickable", "style" => "--user-star-id: $i;", "ratingValue" => $i]);
        }
    div_close();
div_close();

div_open(["class" => "flex left-bigger"]);
    
    div_open();
        showUser($video["creator"], "video-creator", ["showFeedButton" => true]);
        div_open(["id" => "video-details"]);
            div_open(["id" => "video-creation", "class" => "time_tobe_localized"]);
                text(gmdate('c', strtotime($video["creation"])));
            div_close();
            if($video["creator"] == $userid) {
                form_start("/api/videos/visibility.php?v=".$video["id"], [
                    "success" => [
                        "title" => l("saved"),
                        "text" => "",
                        "buttons" => [
                                
                            [l("ok2"), "close"],
                            
                        ]
                    ]
                ]
                );
                
                dropdown("visibility", [
                    "public" => l("vidUpload_visibility_public"),
                    "unlisted" => l("vidUpload_visibility_unlisted"),
                    "private" => l("vidUpload_visibility_private")
                ]);
                
                input(["type" => "submit", "value" => l("save")]);
                form_end();
                
            }
            if($loggedin && $userdata["class"] == "ADMINISTRATOR" && $video["blocked"] == null) {
                a(["href" => "/administration/actions/video/?id=".$video["id"], "text" => "Moderate...", "style" => "color: red;"]);
            }
            if(strlen($video["description"]) > 0 || $video["blocked"] != null) {
                div_open(["id" => "video-description"]);
                    if($video["blocked"] != null) {
                        div_open(["style" => "font-style: italic; color: red;"]);
                            text("Video has been blocked. ");
                            if($loggedin && $userdata["class"] == "ADMINISTRATOR")
                                a(["href" => "/administration/actions/video/?reinstate&id=".$video["id"], "text" => "Reinstate", "style" => "font-style: normal;"]);
                            text("\nReason: ".$video["blocked"]."\n\n");
                        div_close();
                    }
                    if(strlen($video["description"]) > 0)
                        text($video["description"]);
                div_close();
            }
        div_close();
        
        if($loggedin) {
            
            form_start("/api/videos/comment.php?v=".$video["id"]."&replyingTo=0", 
            [
                "success" => [
                    "title" => l("comment_success_header"),
                    "text" => l("comment_success_body"),
                    "buttons" => [
                            
                        [l("ok1"), "close"],
                        
                    ]
                ],
                
                "options" => [
                    
                    "clearOnSubmit" => true
                    
                ]
            ]
            );
            
            
            input(["type" => "textarea",    "name" => "comment",          "placeholder" => l("comment_placeholder")]);
            input(["type" => "submit",      "value" => l("comment_post")]);
            
            form_end();
            
        }
        div_open(["id" => "comments"]);
            $comments = db_query("SELECT id FROM comments WHERE video = ? AND replyingTo = '0'", [$video["id"]])->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($comments as $comment) {
                showComment($comment["id"]);
            }
            
        div_close();
    div_close();
    
    div_open(["class" => "sidebarvideos"]);
        $recommended = getFeed(4*10);
        
        foreach($recommended as $video) {
            
            if(canShowVideo($video))
                showVideo($video);
            
        }
        
    div_close();
    
div_close();



foot();

?>