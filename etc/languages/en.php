<?php

$sitename = "Dynambu";

include_once "_INIT.php";
SET_LANGUAGE_DATA([
    
    "_LICENSE" => "
    $sitename Translations (English) - The language file for $sitename, under the English language.

    Written in 2023 by Sojens sojens@lunarsphere.net

    To the extent possible under law, the author(s) have dedicated all copyright and related and neighboring rights to this software to the public domain worldwide. This software is distributed without any warranty.

    You should have received a copy of the CC0 Public Domain Dedication along with this software. If not, see http://creativecommons.org/publicdomain/zero/1.0/.",
    
    // titles
    
    "home" =>       "Home",
    "explore" =>    "Explore",
    "login" =>      "Login",
    "createAcc" =>  "Create Account",
    "myvideos" =>   "My Videos",
    "profile" =>    "Profile",
    "search" =>     "Search",
    "report" =>     "Report",
    
    "continue_watching" =>  "Continue Watching",
    "unwatched" =>          "Unwatched Videos",
    
    "popular_users" =>      "Popular Users",
    "popular_videos" =>     "Popular",
    "latest_videos" =>      "Latest",
    
    "videos" => "Videos",
    
    "cs" =>                     "Coming soon!",
    "login_required_header" =>  "401",
    "404" =>                    "This page doesn't exist...",
    "403" =>                    "You aren't allowed here!",
    "403_body_text" =>          "This page is admin-only! If you're an admin, please log into your administrator account. If not, go make some videos!",
    "upload" =>                 "Upload",
    "vidUpload" =>              ["upload"],
    
    // descriptions
    
    "desc_explore" => "Explore videos and users on $sitename!",
    "desc_profile" => "See this user's profile, videos, and more on $sitename!",
    "desc_video"   => "Watch this video on $sitename!",
    "desc_upload"  => "Upload a video on $sitename to share it with other people around the world. Whether it be life, animation, or games, $sitename can be your next video sharing platform.",
    "desc_default" => "A page on $sitename, the platform for sharing videos with other people around the world. Whether it be life, animation, or games, $sitename can be your next video sharing platform.",
    
    // menus
    "settings" =>   "Settings",
    "logout" =>     "Log out",
    "save" =>       "Save",
    "saved" =>      "Saved!",
    "settings_saved_body" => "Your new settings have been saved successfully!",
    "pfp" =>        "Logo",
    "pfp_edit" =>   "Select Logo",
    "pfp_cached" => "Please note that changes to your Logo may take up to 12 hours to apply. Clearing your cache will update it immediately, but only for yourself. Other users may need to wait.",
    "ok" =>         "Okay",
    "ok0" =>        "Okay!",
    "ok1" =>        "Alright!",
    "ok2" =>        "Nice!",
    "celebrate" =>  "Woohoo!",
    
    "yes" =>    "Yes",
    "no" =>     "No",
    
    // misc
    "" =>       "[[ Couldn't find English text for: $1 ]]", // $1 is replaced with the text ID that could not be found in the current language (e.g. "createAcc_errors_uname_already_used")
    
    "login_required" =>         "Sorry, but you have to log in to use this page.",
    
    "interactionFail" =>        "We couldn't verify your interaction as a logged-in user. Try logging in again. If you're using this site in a sub-page, please visit the site normally.",
    
    "too_many_requests" =>      "Too many people have submitted this form today. Try again later.",
    "genericError"      =>      "An error has occured while submitting this form.",
    
    "error_accidental_failure" => "Whoops!",
    "error_processing_tooktoolong" => "Looks like this took too long. Don't worry, it's still loading. We don't know when this will complete, though. Periodically check to see if this has finished.",
    
    "could_not_find" => "Couldn't find this video. Check the ID and try again. (Video ID: $1)",
    
    // branding
    "welcome" =>    "Welcome to $sitename!",
    "tagline" =>    "Welcome to $sitename, the platform for sharing videos of life, animation, or games with other people around the world.",
    
    
    // account creation / login
    "uname_format_fail" =>  "Your username must be alphanumeric, also allowing dashes, or underscores.",
    
    "email" =>      "Email",
    "username" =>   "Username",
    "password" =>   "Password",
    
    "createAcc_email_place" =>      "mail@example.com",
    "createAcc_username_place" =>   "Sojens",
    "createAcc_password_place" =>   "*******************",
    
    "createAcc_required_email" =>       "Email is required for account creation.",
    "createAcc_required_uname" =>       "Username cannot be blank!",
    "createAcc_required_password" =>    "You must specify a password for your account.",
    
    "createAcc_errors_uname_toolong" =>     "Your username can't be more than 32 characters long. Don't worry, you can set a display name later, which can be up to 64 characters long.",
    "createAcc_errors_password_toolong" =>  ["errors_password_toolong"],
    
    "createAcc_errors_uname_already_used" =>    ["errors_uname_already_used"],
    
    
    
    "login_email_place" =>      "mail@example.com",
    "login_username_place" =>   "Sojens",
    "login_password_place" =>   "****************",
    
    "login_required_email" =>       "Email is required.",
    "login_required_uname" =>       "Username cannot be blank!",
    "login_required_password" =>    "You can't log in with a blank password.",
    
    "login_errors_uname_toolong" =>     "Your username isn't more than 32 characters long. Remember to log in with your username, and not your display name.",
    "login_errors_password_toolong" =>  "Your password isn't more than 72 characters long.",
    
    "login_error_uname" =>      "No user with that name exists. Remember to log in with your username, and not your display name.",
    "login_error_password" =>   "That's the wrong password!",
    
    
    "loggedin" =>   "You have been logged into your account!",
    
    "gohome" =>         "Take me home!",
    "goconfigure" =>    "Edit my new profile!",
    
    // users
    "bio" => "Bio",
    "bio_place" => "Hello everyone! Welcome to my profile! Here, I post videos of things I do throughout the day.",
    "featured_video" => "Featured Video",
    
    // user errors
    "errors_uname_toolong" =>       "Your username can't be more than 32 characters long.",
    "errors_password_toolong" =>    "Your password can't be more than 72 characters long. (Seriously?)",
    "errors_uname_already_used" =>  "Someone already has that username!",
    "errors_bio_toolong" =>         "Your bio can't be more than 1024 characters long.",
    
    // videos
    "visit" =>          "Visit Page",
    "feed_add" =>       "Add to Feed",
    "feed_remove" =>    "Remove from Feed",
    
    "video_title_placeholder" =>        "My Awesome Video",
    "video_description_placeholder" =>  "Hello, this is the description of my awesome video. This video took me 2 whole months to shoot, edit, and produce. I hope you enjoy watching it!",
    
    "comments_header" =>            "Comments",
    
    "comment_placeholder" =>        "Write a comment",
    "comment_textfield_error" =>    "You have to enter text into the comment field in order to post one. I see what you're trying to do, but it won't work.",
    "comment_textfield_toolong" =>  "The text you've inserted is more than 1000 characters. Please don't do that.",
    "comment_post" =>               "Post comment",
    "comment_reply" =>              "Reply",
    
    "comment_success_header" => "Comment added!",
    "comment_success_body" =>   "Your comment has been added!",
    
    //uploading
    "title" =>              "Title",
    "description" =>        "Description",
    "vidUpload_video" =>    "Select Video",
    
    "vidUpload_visibility_public" =>    "Public",
    "vidUpload_visibility_unlisted" =>  "Unlisted",
    "vidUpload_visibility_private" =>   "Private",
    
    "vidUpload_required_title" =>   "You must set a title!",
    "vidUpload_required_video" =>   "You must select a video!",
    
    "vidUpload_error_nonvideo" =>           "That's not a video!",
    "vidUpload_error_notsupported" =>       "We couldn't figure out some information about this video. Try submitting it in a different format, or retrying.",
    
    "uploaded" =>       "Your video has been uploaded!",
    "uploaded_body" =>  "Your video has been uploaded. Want to go see it?",
    
    // reports
    "report_summary" => "Summary",
    "report_summary_place" => "Write a short summary here about what you didn't like.",
    "report_summary_required" => "Please submit a short summary on why you submitted this. It doesn't have to be long, we need a bit of detail on the issue so we can see if it is important or not.",
    "report_check_good" => "Make sure your report is helpful to the moderation team. Do not report videos that are not breaking any rules.",
    
    
    "report_thanks" => "Thank you for submitting a report.",
    "report_thanks_body" => "We thank you for submitting a report. While it may not seem like much, reporting content to the moderation team can help make $sitename a better platform."
    
]);

?>