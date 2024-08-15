<?php

api_require_login();

setcookie("login", "", [
    "expires" => (time()-3600),
    "path" => "/",
    "secure" => true,
    "httponly" => true,
    "samesite" => "None"
]);

header("Location: /");

exit();

?>