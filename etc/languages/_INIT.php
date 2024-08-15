<?php

$languages = [
    "en" => "English",
    "sv" => "Svenska",
    "bork" => "Broken",
    "thugadugary" => "thugadugary"
];

$selected_language = isset($_COOKIE["language"]) ? $_COOKIE["language"] : "en";
if(!isset($languages[$selected_language]))
    $selected_language = "en";


function SET_LANGUAGE_DATA($languageData) {
    global $l, $lang;
    
    foreach($languageData as $key => $value) {
        
        if(is_array($value))
            $languageData[$key] = $languageData[$value[0]];
        
    }
    
    $l = $lang = $languageData;
    
}

//"home_cs" =>"The home page is coming soon. Here, you'll be able to see videos by users you've added to your feed. For now, though, this page doesn't have anything.",

?>