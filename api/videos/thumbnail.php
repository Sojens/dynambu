<?php

$v = db_query("SELECT * FROM videos WHERE id = ?", [$_GET["v"]]);

if($v->rowCount() == 0)
    api_error(["v" => "video doesn't exist!"]);
$vData = $v->fetch(PDO::FETCH_ASSOC);

$seconds_to_cache = 30*24*60*60;
$ts = gmdate("D, d M Y H:i:s", time() + $seconds_to_cache) . " GMT";
header("Expires: $ts");
header("Pragma: cache");
header("Cache-Control: max-age=$seconds_to_cache");

$p = "$datapath/".$vData["thumbnail"];
//header("Content-Type: ".mime_content_type($p));
//echo file_get_contents($p);

header('content-type: image/jpeg');

$im = imagecreatefrompng($p);
$size = ['x' => imagesx($im), 'y' => imagesy($im)];

if ($im !== FALSE) {
    if($size > 128) {
        
        $im3 = imagescale($im, 400);
        if($im3 == FALSE) {
            
            $im3 = $im;
            
        }
        
    } else {
        
        $im3 = $im;
        
    }
    
    imagejpeg($im3, null, 80);
    imagedestroy($im3);
    
}
imagedestroy($im);


?>