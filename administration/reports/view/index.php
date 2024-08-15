<?php


require_login();
require_class("ADMINISTRATOR");
head(l("report"), ["pagetype" => "full"]);

$report = db_query("SELECT * FROM reports WHERE id = ?", [$_GET["id"]]);

if($report->rowCount() == 0)
    pagenotfound();

$report = $report->fetch(PDO::FETCH_ASSOC);

showUser($report["creator"]);


if(strlen($report["summary"]) > 0) {
    div_open(["id" => "video-description"]);
        text($report["summary"]);
    div_close();
} else {
    p("No summary has been provided.");
}

if(REPORT_TYPES[$report["type"]] != "") {
    ?>
    <div class="actions">
        <a href="<?= str_replace("$1", $report["content"], REPORT_TYPES[$report["type"]]["link"]) ?>">View content</a>
    </div>
    <?php
}

foot();

?>