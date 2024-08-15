<?php

head(l("createAcc"), ["pagetype" => "mini"]);


form_start("/api/accounts/create.php", 
    [
        "success" => [
            "title" => l("welcome"),
            "text" => l("tagline")."\n\n".l("loggedin"),
            "buttons" => [
                    
                [l("gohome"),      "link", "/"],
                [l("goconfigure"), "link", "/account/"],
                
            ]
        ]
    ]
);
input(["type" => "email", "name" => "email", "label" => l("email"), "placeholder" => l("createAcc_email_place")]);
input(["type" => "text", "name" => "uname", "label" => l("username"), "placeholder" => l("createAcc_username_place")]);
input(["type" => "password", "name" => "password", "label" => l("password"), "placeholder" => l("createAcc_password_place")]);
input(["type" => "submit", "value" => l("createAcc")]);
form_end();

foot();

?>