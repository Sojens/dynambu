<?php

header("Access-Control-Allow-Origin: *");
$userquery = db_query("SELECT id, username, bio, creation, CONCAT('$primary_site/api/accounts/getLogo.php?id=', id) AS logo FROM users WHERE id = ?", [$_GET["u"]]);

if($userquery->rowCount() < 1)
    api_error(["genericError" => "Couldn't fetch user."]);

api_success($userquery->fetch(PDO::FETCH_ASSOC));

?>