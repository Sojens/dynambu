<?php

require_login();
head(l("vidUpload"), ["pagetype" => "mini", "description" => l("desc_upload")]);


form_start("/api/videos/upload.php", 
    [
        "success" => [
            "title" => l("uploaded"),
            "text" => l("uploaded_body"),
            "buttons" => [
                    
                [l("yes"),      "link", ["str" => "/v/!/", "replace" => "!", "replaceWith" => "id"]],
                
            ]
        ]
    ]
);

input(["type" => "text",        "name" => "title",          "label" => l("title"),              "placeholder" => l("video_title_placeholder")]);
input(["type" => "textarea",    "name" => "description",    "label" => l("description"),        "placeholder" => l("video_description_placeholder"),    "required" => false]);
dropdown("visibility", [
    "public" => l("vidUpload_visibility_public"),
    "unlisted" => l("vidUpload_visibility_unlisted"),
    "private" => l("vidUpload_visibility_private")
]);
input(["type" => "file",        "name" => "video",          "label" => l("vidUpload_video")]);
input(["type" => "submit", "value" => l("vidUpload")]);
form_end();

foot();

?>