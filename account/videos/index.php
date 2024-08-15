<?php

require_login();
head(l("myvideos"), ["pagetype" => "full"]);

div_open(["class" => "videos-list"]);

$videos = db_query("SELECT * FROM videos WHERE creator = ? ORDER BY creation DESC", [$userid])->fetchAll(PDO::FETCH_ASSOC);

foreach($videos as $v)
    showVideo($v);

foot();

?>