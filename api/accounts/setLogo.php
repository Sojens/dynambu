<?php

api_require_login();

if (api_require([
    "image" => "image must be specified", 
]))
{
    
    $f = api_get_file($_POST["image"]);
    
    $supported = [IMAGETYPE_JPEG, IMAGETYPE_GIF, IMAGETYPE_PNG, IMAGETYPE_WEBP];
    
    
    $file_size= filesize($f["path"]);
    $file_ext = exif_imagetype($f["path"]);
    
    $type = pathinfo("$datapath/".$f["path"], PATHINFO_EXTENSION);
    $data = file_get_contents("$datapath/".$f["path"]);
    
    if($file_size > intval("20"/*MEGABYTES*/."000000"/*BYTES*/)) {
        
        api_error(['image' => ">20MB :("]);
        $error = true;
        
    } else {
        
        $pfpid = randID();
        imagepng(imagecreatefromstring($data), "$datapath/$pfpid.png");
        db_query("UPDATE users SET pfp = ? WHERE id = ?", [$pfpid, $userid]);
        api_success();
        
    }
    
    
}

?>