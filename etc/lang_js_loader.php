<?php

header("content-type: text/javascript");


ini_set('zlib.output_compression', 1);

if(isset($l["_LICENSE"]))
    echo "/*\n".$l["_LICENSE"]."\n\n*/\n\n";

echo "window.l=(f)=>(".json_encode($l).")[f]";


?>