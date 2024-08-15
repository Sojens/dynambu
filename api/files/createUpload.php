<?php

api_require_login();

if(api_require([
    "uploading" => "file count must be provided in request",
    "chunkSize" => "chunk size must be specified (in bytes)",
])) {
    
    if($_POST["uploading"] > 20)
        api_error(["uploading" => "you cannot upload more than 15 chunks"]);
    if($_POST["chunkSize"] > 50*1000*1000)
        api_error(["chunkSize" => "a chunk must be less than 50 mb in size"]);
    
    if(db_query("SELECT * FROM uploads WHERE timeStarted > TIMESTAMP(DATE_SUB(NOW(), INTERVAL 1 day))")->rowCount() > 40)
        api_error(["genericError" => l("too_many_requests")]);
        
    $id = randID();
    $key = randID();
    
    db_query("INSERT INTO uploads (id, passkey, count, file, chunkSize) VALUES (?,?,?,'',?)", [$id, password_hash($key, PASSWORD_BCRYPT), $_POST["uploading"], $_POST["chunkSize"]]);
    
    
    
    api_success([
        "id" => $id,
        "passkey" => $key,
    ]);
    
}

?>