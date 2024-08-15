<?php



require_login();
require_class("ADMINISTRATOR");

$video = db_query("SELECT * FROM videos WHERE id = ?", [$_GET["id"]]);

if($video->rowCount() == 0)
    pagenotfound();

$video = $video->fetch(PDO::FETCH_ASSOC);

head("Video Actions", ["pagetype" => "mini"]);




showUser($video["creator"]);
showPlayer($video["id"]);

p("Please ensure that this is the correct video, and that you are ready to take action necessary.");


form_start("/api/administration/action.php?type=VIDEO&content=".urlencode($video["id"]), 
    [
        "success" => [
            "title" => "Operation Complete.",
            "text" => "",
            "buttons" => [
                    
                ["Other Reports", "link", "/administration/reports/"],
                
            ]
        ]
    ]
);

if(isset($_GET["reinstate"]))
    dropdown("action", ["reinstate" => "Reinstate video."]);
else
    dropdown("action", [
        
        "block" => "Block"
        
    ]);
input(["type" => "textarea", "name" => "reason", "label" => "Reason", "placeholder" => "This video was removed for being inappropriate. (details)"]);
input(["type" => "submit", "value" => l("submit")]);
form_end();



foot();

// "*Video Title*"
// *Show video*
// Please make sure that this is the correct video, and that you are ready to take action necessary.


?>