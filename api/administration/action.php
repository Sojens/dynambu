<?php

api_require_login();
api_require_class("ADMINISTRATOR");

if(api_require([
    "action" => "action must be provided -- please do not use this form through the API!",
    "reason" => "reason must be provided -- please do not use this form through the API!",
    "g.content" => "content must be provided -- please do not use this form through the API!",
    "g.type" => "type must be provided -- please do not use this form through the API!",
])) {
    
    REPORT_TYPES[$_GET["type"]]["action"]($_GET["content"], $_POST["action"], $_POST["reason"]);
    db_query("INSERT INTO action_log (action, type, reason, content, ip, creator) VALUES (?,?,?,?,?,?)", [$_POST["action"], $_GET["type"], $_POST["reason"], $_GET["content"], $_SERVER["REMOTE_ADDR"], $userid]);
    api_success();
    
}

?>