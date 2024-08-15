<?php

header("Access-Control-Allow-Origin: *");

if(api_require([
    "uname" =>    l("login_required_uname"),
    "password" => l("login_required_password")])) {
    $errors = [];
    if(strlen($_POST["uname"]) > 32)
        $errors["uname"] = l("login_errors_uname_toolong");
    if(strlen($_POST["password"]) > 72)
        $errors["password"] = l("login_errors_password_toolong");
    $u = db_query("SELECT * FROM users WHERE username = ?", [$_POST["uname"]]);
    if($u->rowCount() == 0)
        $errors["uname"] = l("login_error_uname");
    else {
        $u_assoc = $u->fetch(PDO::FETCH_ASSOC);
        
        if(!password_verify($_POST["password"], $u_assoc["password"]))
            $errors["password"] = l("login_error_password");
        
    }
    if(preg_match("/[^a-zA-Z0-9_-]/", $_POST["uname"]))
        $errors["uname"] = l("uname_format_fail");
    
    if(count($errors) === 0) {
        $token = login_user($u_assoc["id"]);
        api_success(["token" => $token]);
    } else {
        $outcome = API_REQUEST_ERROR;
        $outcome["errors"] = $errors;
        api_response($outcome);
    }
}

?>