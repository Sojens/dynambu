<?php

$sitename = "Dynambu";

include_once "_INIT.php";
SET_LANGUAGE_DATA([
    
    "_LICENSE" => "
    $sitename Translations (Bork) - The language file for $sitename, under the broken language.

    Written in 2024 by the Impracticalist

    To the extent possible under law, the author(s) have dedicated all copyright and related and neighboring rights to this software to the public domain worldwide. This software is distributed without any warranty.

    You should have received a copy of the CC0 Public Domain Dedication along with this software. If not, see http://creativecommons.org/publicdomain/zero/1.0/.",
    
    // titles
    
    "home" =>       "",
    "explore" =>    "",
    "login" =>      "",
    "createAcc" =>  "",
    "myvideos" =>   "",
    "profile" =>    "",
    "search" =>     "",
    "report" =>     "",
    
    "continue_watching" =>  "",
    "unwatched" =>          "",
    
    "popular_users" =>      "",
    "popular_videos" =>     "",
    "latest_videos" =>      "",
    
    "videos" => "",
    
    "cs" =>                     "",
    "login_required_header" =>  "",
    "404" =>                    "",
    "403" =>                    "",
    "403_body_text" =>          "",
    "upload" =>                 "",
    "vidUpload" =>              ["upload"],
    
    // descriptions
    
    "desc_explore" => "",
    "desc_profile" => "",
    "desc_video"   => "",
    "desc_upload"  => "",
    "desc_default" => "",
    
    // menus
    "settings" =>   "",
    "logout" =>     "",
    "save" =>       "",
    "saved" =>      "",
    "settings_saved_body" => "",
    "pfp" =>        "",
    "pfp_edit" =>   "",
    "pfp_cached" => "",
    "ok" =>         "",
    "ok0" =>        "",
    "ok1" =>        "",
    "ok2" =>        "",
    "celebrate" =>  "",
    
    "yes" =>    "",
    "no" =>     "",
    
    // misc
    "" =>       "[[ Couldn't find English text for: $1 ]]", // $1 is replaced with the text ID that could not be found in the current language (e.g. "createAcc_errors_uname_already_used")
    
    "login_required" =>         "",
    
    "interactionFail" =>        "",
    
    "too_many_requests" =>      "",
    "genericError"      =>      "",
    
    "error_accidental_failure" => "",
    "error_processing_tooktoolong" => "",
    
    "could_not_find" => "",
    
    // branding
    "welcome" =>    "",
    "tagline" =>    "",
    
    
    // account creation / login
    "uname_format_fail" =>  "",
    
    "email" =>      "",
    "username" =>   "",
    "password" =>   "",
    
    "createAcc_email_place" =>      "",
    "createAcc_username_place" =>   "",
    "createAcc_password_place" =>   "",
    
    "createAcc_required_email" =>       "",
    "createAcc_required_uname" =>       "",
    "createAcc_required_password" =>    "",
    
    "createAcc_errors_uname_toolong" =>     "",
    "createAcc_errors_password_toolong" =>  ["errors_password_toolong"],
    
    "createAcc_errors_uname_already_used" =>    ["errors_uname_already_used"],
    
    
    
    "login_email_place" =>      "",
    "login_username_place" =>   "",
    "login_password_place" =>   "",
    
    "login_required_email" =>       "",
    "login_required_uname" =>       "",
    "login_required_password" =>    "",
    
    "login_errors_uname_toolong" =>     "",
    "login_errors_password_toolong" =>  "",
    
    "login_error_uname" =>      "",
    "login_error_password" =>   "",
    
    
    "loggedin" =>   "",
    
    "gohome" =>         "",
    "goconfigure" =>    "",
    
    // users
    "bio" => "",
    "bio_place" => "",
    "featured_video" => "",
    
    // user errors
    "errors_uname_toolong" =>       "",
    "errors_password_toolong" =>    "",
    "errors_uname_already_used" =>  "",
    "errors_bio_toolong" =>         "",
    
    // videos
    "visit" =>          "",
    "feed_add" =>       "",
    "feed_remove" =>    "",
    
    "video_title_placeholder" =>        "",
    "video_description_placeholder" =>  "",
    
    "comments_header" =>            "",
    
    "comment_placeholder" =>        "",
    "comment_textfield_error" =>    "",
    "comment_textfield_toolong" =>  "",
    "comment_post" =>               "",
    "comment_reply" =>              "",
    
    "comment_success_header" => "",
    "comment_success_body" =>   "",
    
    //uploading
    "title" =>              "",
    "description" =>        "",
    "vidUpload_video" =>    "",
    
    "vidUpload_visibility_public" =>    "",
    "vidUpload_visibility_unlisted" =>  "",
    "vidUpload_visibility_private" =>   "",
    
    "vidUpload_required_title" =>   "",
    "vidUpload_required_video" =>   "",
    
    "vidUpload_error_nonvideo" =>           "",
    "vidUpload_error_notsupported" =>       "",
    
    "uploaded" =>       "",
    "uploaded_body" =>  "",
    
    // reports
    "report_summary" => "",
    "report_summary_place" => "",
    "report_summary_required" => "",
    "report_check_good" => "",
    
    
    "report_thanks" => "",
    "report_thanks_body" => ""
    
]);

?>