<?php

require_login();

if(!in_array($_GET["type"], array_keys(REPORT_TYPES)) || !isset($_GET["content"]))
    die("Invalid request."); // TODO: fix this shit


head(l("report"), ["pagetype" => "mini"]);


form_start("/api/reports/report.php?type=".urlencode($_GET["type"])."&content=".urlencode($_GET["content"]), 
    [
        "success" => [
            "title" => l("report_thanks"),
            "text" => l("report_thanks_body"),
            "buttons" => [
                    
                [":)", "link", "/"],
                
            ]
        ]
    ]
);
input(["type" => "textarea", "name" => "summary", "label" => l("report_summary"), "placeholder" => l("report_summary_place")]);
input(["type" => "submit", "value" => l("report")]);
form_end();

foot();

?>