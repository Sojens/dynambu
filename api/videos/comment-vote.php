<?php

api_require_login();

if (api_require([
    "rating" => "ya gotta specify a rating value, either -1 or 1 (although, this is banned by the ToS... dont rate stuff from the api if you can help it)",
    "comment" => "ya gotta specify a comment to rate (although, man, this is banned by the ToS, so probably dont rate stuff from the api pls)"
]))
{
    
    if($_POST['rating'] != 1 && $_POST["rating"] != -1)
        api_error("invalid rating...");
    
    $comment = db_query("SELECT * FROM comments WHERE id = ?", [$_POST["comment"]]);
    if($comment->rowCount() == 0)
        api_error(["comment" => "that comment doesn't exist.. what are you trying to do?"]);
    $comment = $comment->fetch(PDO::FETCH_ASSOC);
    
    if($comment["creator"] == $userid)
        api_error(["comment" => "you made that comment... you can't vote on yourself"]);
    
    if(db_query("SELECT * FROM comments_votes WHERE creator = ? AND comment = ? AND value = ?", [$userid, $comment["id"], $_POST["rating"]])->rowCount() > 0)
        api_error(["rating" => "rating not changed"]);
    
    if(db_query("SELECT * FROM comments_votes WHERE creator = ? AND comment = ?", [$userid, $comment["id"]])->rowCount() <= 0)
        db_query("INSERT INTO comments_votes (value, comment, creator) VALUES (?,?,?)", [$_POST["rating"], $comment["id"], $userid]);
    else
        db_query("UPDATE comments_votes SET value = ? WHERE comment = ? AND creator = ?", [$_POST["rating"], $comment["id"], $userid]);
    
    api_success(["newValue" => db_query("SELECT COALESCE(SUM(value),0) AS rating FROM comments_votes WHERE comment = ?", [$comment["id"]])->fetch(PDO::FETCH_ASSOC)["rating"]]);
    
}


?>