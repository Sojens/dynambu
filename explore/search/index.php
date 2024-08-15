<?php

head(l("search"), ["pagetype" => "full"]);

$videos = videos_search($_GET["q"] ?: $sitename);

form_start("/explore/search/", 
    [
        "type" => "normal",
        "method" => "GET",
        "id" => "search"
    ]
);

input(["type" => "text", "value" => $_GET["q"],    "name" => "q",          "placeholder" => l("search")]);

form_end();

div_open(["class" => "bigvideos"]);
    foreach($videos as $v) {
        if(canShowVideo($v))
            showVideo($v);
    }
div_close();

foot();

?>