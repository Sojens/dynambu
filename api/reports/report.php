<?php

api_require_login();

if(api_require([
    "g.content" => "content was not defined -- i also ask that you please do not use this form through an API tool, as that disrupts moderator work that could be used on actual things.",
    "g.type" => "type was not defined -- i also ask that you please do not use this form through an API tool.",
    "summary" => l("report_summary_required")
])) {
    
    if(!in_array($_GET["type"], array_keys(REPORT_TYPES)) || !isset($_GET["content"]))
        api_error(["genericError" => "Invalid report type. Please go back, or check the URL."]);
    
    if(REPORT_TYPES[$_GET["type"]] == "" || db_query(REPORT_TYPES[$_GET["type"]]["query"], [$_GET["content"]])->rowCount() <= 0)
        api_error(["genericError" => "Content provided does not exist."]);
    
    db_query("INSERT INTO reports (summary, type, content, creator) VALUES (?,?,?,?)", [$_POST["summary"], $_GET["type"], $_GET["content"], $userid]);
    api_success();
    
}

?>