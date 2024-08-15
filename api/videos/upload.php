<?php


if (api_require([
    "title" => "a title must be specified", 
    "video" => "a file ID must be specified",
]))
{
    
    $f = api_get_file($_POST["video"]);
    $file_id    =    $f["id"];
    $file_orig  =    $f["path"];
    $file_type  =    $f["type"];
    $file_ext   =    $f["ext"];
    
    $file_path = "$datapath/".$f["id"].".$file_ext";
    rename("$datapath/$file_orig", $file_path);
    
    $allowed_extensions = array("webm", "mp4", "mov", "mkv");
    $pattern = implode ("|", $allowed_extensions);
    
    
    //if (preg_match("/^($pattern)$/i", $file_ext)) {
        
    if (($file_type == "video/webm") || ($file_type == "video/mp4") || ($file_type == "video/ogv") || ($file_type == "video/quicktime") || ($file_type == "video/x-matroska")) {
        
        $title = $_POST["title"];
        $description = isset($_POST["description"]) ? $_POST["description"] : "";
        
        $n1 = "$file_id.nometa.$file_ext";
        
        shell_exec  ('ffmpeg -i "'.$file_path.'" -map_metadata -1 -c:v copy -c:a copy "'."$datapath/$n1".'"');
        unlink ($file_path);
        
        $final = "$file_id.mp4";
        shell_exec  ('ffmpeg -i "'."$datapath/$n1".'" -c:v libx264 -preset medium -crf 22 -c:a aac -vf format=yuv420p,"crop=trunc(iw/2)*2:trunc(ih/2)*2" "'."$datapath/$final".'"');
        unlink ("$datapath/$n1");
        
        $music = 0;
        
        if(isset($_POST["music"]) && $_POST["music"] == "Yes") {
            
            $music = 1;
            
        }
        $visibility = 0;
        
        if(isset($_POST["visibility"])) {
            
            $visibility = ["public" => 0, "unlisted" => 1, "private" => 2][$_POST["visibility"]];
            
        }
        
        
        shell_exec  ('ffmpeg -i "'."$datapath/$final".'" -ss '.gmdate("H:i:s", (shell_exec("ffprobe -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 $datapath/$final")/3)%86400).' -f image2 -frames:v 1 "'."$datapath/$file_id.png".'"');
        
        
        $video_id = str_shuffle(randID_short());
        
        db_query("INSERT INTO videos (id, title, source, thumbnail, description, creator, visibility) VALUES (?,?,?,?,?,?,?)", [
            $video_id,          // id
            $title,             // title
            "$final",           // source
            "$file_id.png",     // thumbnail
            $description,       // description
            $userid,            // creator
            $visibility,        // visibility
        ]);
        
        
        api_success(["id" => $video_id]);
    } else {
        api_error(["video" => l("vidUpload_error_notsupported")." -- Bad Content-Type: ".$file_type]);
    }
    
    /*} else {
        api_error(["video" => l("vidUpload_error_nonvideo")]);
    }*/
    
} 