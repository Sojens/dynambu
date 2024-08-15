<?php

api_require_login();

if(api_require([
    "id" => "upload id must be provided in request",
    "passkey" => "passkey must be provided in request",
    "chunk" => "chunk number must be provided in request",
    "!F:chunkData" => "chunk data must be provided in request",
])) {
    
    $upload = db_query("SELECT * FROM uploads WHERE id = ?", [$_POST["id"]]);
    if($upload->rowCount() == 0)
        api_error(["id" => "no upload with that id exists"]);
    $upload = $upload->fetch(PDO::FETCH_ASSOC);
    if(!password_verify($_POST["passkey"], $upload["passkey"]))
        api_error(["passkey" => "incorrect passkey (i literally just gave it to you how do you forget it)"]);
    
    if($upload["uploaded"] >= $upload["count"])
        api_error(["id" => "all chunks have already been uploaded you dumbo"]);
    
    $chunkNumber = 0;
    if(!is_numeric($_POST["chunk"]) || (Int) $_POST["chunk"] < 0 || (Int) $_POST["chunk"] > $upload["count"])
        api_error(["chunk" => "chunk number is invalid"]);
    else
        $chunkNumber = (Int) $_POST["chunk"];
    
    
    if($_FILES['chunkData']['size'] > $upload["chunkSize"]+128 || $_FILES['chunkData']['size'] < $upload["chunkSize"]-128)
        api_error(["chunkData" => "chunk size does not fit specified chunk size set in upload creation (error range of 128 bytes went over)"]);
    
    $uploaded_path = "$datapath/".$upload["id"]."_$chunkNumber";
    if(is_uploaded_file($_FILES['chunkData']['tmp_name']) && !file_exists($uploaded_path)) {
        move_uploaded_file($_FILES["chunkData"]['tmp_name'], $uploaded_path);
    } else {
        api_error(["chunkData" => "what the fuck did you do"]);
    }
    
    db_query("UPDATE uploads SET uploaded = uploaded + 1 WHERE id = ?", [$upload["id"]]);
    $upload = db_query("SELECT * FROM uploads WHERE id = ?", [$upload["id"]])->fetch(PDO::FETCH_ASSOC);
    
    
    $types = [  
        'video/mp4'                                                                 => 'mp4',
        'video/mpeg'                                                                => 'mpeg',
        'video/ogg'                                                                 => 'ogg',
        'video/webm'                                                                => 'webm',
        'video/x-ms-wmv'                                                            => 'wmv',
        'video/x-ms-asf'                                                            => 'wmv',
        'video/quicktime'                                                           => 'mov',
        'video/x-matroska'                                                          => 'mkv',
        
        "image/png"                                                                 => "png",
        "image/jpeg"                                                                => "jpeg",
        "image/bmp"                                                                 => "bmp",
        "image/gif"                                                                 => "gif",
        "image/heic"                                                                => "heic",
        "image/heif"                                                                => "heif",
        "image/webp"                                                                => "webp",
    ];
    
    if($upload["uploaded"] == $upload["count"]) {
        for($i = 1; $i < $upload["count"]+1; $i++) {
            
            $fp = "$datapath/".$upload["id"]."_$i";
            $content = file_get_contents($fp);
            file_put_contents("$datapath/".$upload["id"], $content, FILE_APPEND);
            unlink($fp);
            
        }
        
        $p = $upload["id"];
        $ctype = mime_content_type("$datapath/$p");
        
        if(isset($types[$ctype])) {
            $origp = $p;
            $p = $p.".".$types[$ctype];
            rename("$datapath/$origp", "$datapath/$p");
            
            db_query("UPDATE uploads SET file = ? WHERE id = ?", [$p, $upload["id"]]);
            
            api_response(API_SUCCESS_DEFAULT);
        } else {
            
            api_error(["genericError" => "file is not in a supported format"]);
            
        }
        
    }
    
    api_response(API_SUCCESS_DEFAULT);
    
}

?>