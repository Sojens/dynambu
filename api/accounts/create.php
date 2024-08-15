<?php

if(api_require([
    "email" =>    l("createAcc_required_email"),
    "uname" =>    l("createAcc_required_uname"),
    "password" => l("createAcc_required_password")])) {
    $errors = [];
    if(strlen($_POST["password"]) > 72)
        $errors["password"] = l("createAcc_errors_password_toolong");
    $error = validate_username($_POST["uname"]);
    if($error !== true)
        $errors["uname"] = $error;
    if(db_query("SELECT * FROM users WHERE creation > TIMESTAMP(DATE_SUB(NOW(), INTERVAL 1 day))")->rowCount() >= 2)
        $errors["genericError"] = l("too_many_requests");
        
        
    if(preg_match("/[^a-zA-Z0-9_-]/", $_POST["uname"]))
        $errors["uname"] = l("uname_format_fail");
    
    if(count($errors) === 0) {
        $uid = randID_short();
        db_query("INSERT INTO users (id, username, email, password) VALUES (?,?,?,?)", [$uid, $_POST["uname"], $_POST["email"], password_hash($_POST["password"], PASSWORD_BCRYPT)]);
        login_user($uid);
        api_response(API_SUCCESS_DEFAULT);
    } else {
        $outcome = API_REQUEST_ERROR;
        $outcome["errors"] = $errors;
        api_response($outcome);
    }
}

?>