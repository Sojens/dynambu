<?php

require_login();
head(l("pfp"), ["pagetype" => "mini"]);


form_start("/api/accounts/setLogo.php", 
    [
        "success" => [
            "title" => l("pfp"),
            "text" => l("pfp_cached"),
            "buttons" => [
                    
                [l("ok2"),      "link", "/u/".$username."/"],
                
            ]
        ]
    ]
);

input(["type" => "file",        "name" => "image",          "label" => l("pfp_edit")]);
input(["type" => "submit", "value" => l("upload")]);
form_end();

foot();

?>