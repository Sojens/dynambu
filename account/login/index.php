<?php

head(l("login"), ["pagetype" => "mini"]);


form_start("/api/accounts/login.php", 
    [
        "success" => [
            "title" => l("welcome"),
            "text" => l("loggedin"),
            "buttons" => [
                    
                [l("gohome"),      "link", $_GET["ref"] ? "/".$_GET["ref"] : "/"],
                
            ]
        ]
    ]
);
input(["type" => "text", "name" => "uname", "label" => l("username"), "placeholder" => l("login_username_place")]);
input(["type" => "password", "name" => "password", "label" => l("password"), "placeholder" => l("login_password_place")]);
input(["type" => "submit", "value" => l("login")]);
form_end();

foot();

?>