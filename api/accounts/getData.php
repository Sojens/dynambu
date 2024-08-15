<?php

header("Access-Control-Allow-Origin: *");
api_require_login();
api_success(db_query("SELECT id, username, email, bio, creation FROM users WHERE id = ?", [$userid])->fetch(PDO::FETCH_ASSOC));

?>