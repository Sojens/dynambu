<?php



require_login();
require_class("ADMINISTRATOR");
head("Reports", ["pagetype" => "full"]);

$reports = db_query("SELECT * FROM reports ORDER BY creation DESC")->fetchAll(PDO::FETCH_ASSOC);
div_open(["class" => "data-list"]);

foreach($reports as $report) {
    
    div_open(["class" => "entry"]);
        div_open(["class" => "entry-description"]);
            link_open(["href" => "view/?id=".$report["id"]]);
                p($report["summary"]);
            link_close();
        div_close();
        div_open(["class" => "creator"]);
            showUser($report["creator"]);
        div_close();
    div_close();
    
}

div_close();
foot();


?>