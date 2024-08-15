<?php

require_login();

head(l("settings"), ["pagetype" => "mini"]);
//showUser($userid, "settingsUser");

a(["href" => "/account/logo/", "text" => l("pfp_edit")]);
form_start("/api/accounts/settingsUpdate.php", 
    [
        "success" => [
            "title" => l("saved"),
            "text" => l("settings_saved_body"),
            "buttons" => [
                    
                [l("ok1"), "close"],
                
            ]
        ]
    ]
);

foreach($settings as $setting) {
    
    $qe = $setting;
    
    $qe["type"] = $setting["inputType"];
    $qe["name"] = $setting["id"];
    $qe["label"] = $setting["name"];
    //$qe["value"] = $setting["value"];
    $qe["placeholder"] = $setting["placeholder"] ?: "";
    //["type" => $setting["inputType"], "name" => $setting["id"], "label" => $setting["name"]]
    input($qe);
    
}


input(["type" => "submit", "value" => l("save")]);
form_end();

foot();

?>