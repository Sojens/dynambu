<?php

api_require_login();

$requiredSettings = [];
foreach($settings as $s) {
    
    $requiredSettings[$s["id"]] = 'you must specify the value for this setting';
    
}
if(api_require($requiredSettings)) {
    
    $errors = [];
    $settings_final = [];
    foreach($settings as $s) {
        
        $v = $_POST[$s["id"]];
        $settings_final[$s["id"]] = $v;
        $validated = $s["validate"]($v);
        if($validated !== true)
            $errors[$s["id"]] = $validated;
        
    }
    if(count($errors) > 0)
        api_error($errors);
    
    $q = "UPDATE users SET";
    
    $first = "";
    foreach($settings_final as $setting => $value) {
        
        $q.= "$first $setting = ?";
        $first = ",";
        
    }
    $q.=" WHERE id = ?";
    db_query($q, array_merge(array_values($settings_final), [$userid]));
    
    api_success();
}

?>