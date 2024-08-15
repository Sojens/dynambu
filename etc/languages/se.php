<?php

include_once "_INIT.php";
SET_LANGUAGE_DATA([
    
    "_LICENSE" => "
    $sitename Translations (Swedish) - The language file for $sitename, under the Swedish language.

    Written in 2023 by Zagyen8913 zenmoroni8913@gmail.com

    To the extent possible under law, the author(s) have dedicated all copyright and related and neighboring rights to this software to the public domain worldwide. This software is distributed without any warranty.

    You should have received a copy of the CC0 Public Domain Dedication along with this software. If not, see http://creativecommons.org/publicdomain/zero/1.0/.",

    // titles
    
    "home" =>       "Huvudsida",
    "explore" =>    "Alla videor",
    "login" =>      "Logga in",
    "createAcc" =>  "Skapa konto",
    "myvideos" =>   "Mina videor",
    "profile" =>    "Profil",
    
    "continue_watching" =>  "Fortsätt titta",
    "unwatched" =>          "Osedda videor",
    
    "popular_users" =>      "Populära användare",
    "popular_videos" =>     "Populära",
    "latest_videos" =>      "Senaste",
    
    "videos" => "Videor",
    
    "cs" =>                     "Inte tillgängligt ännu...",
    "login_required_header" =>  "401",
    "404" =>                    "Denna sida finns inte...",
    "vidUpload" =>              "Ladda upp video",
    
    // descriptions
    
    "desc_explore" => "Se alla videor och användare på $sitename!",
    "desc_profile" => "Se denna användares profil, videor m.fl. på $sitename!",
    "desc_video"   => "Se denna video på $sitename!",
    "desc_upload"  => "Ladda up en video på $sitename för att dela den med andra personer runt om i världen. Oavsett om det är vardagsliv, animering eller spel, så kan $sitename vara nästa videodelningssida du använder.",
    "desc_default" => "En sida på $sitename, webbsidan för att dela videor med andra personer runt om i världen. Oavsett om det är vardagsliv, animering eller spel, så kan $sitename vara nästa videodelningssida du använder.",
    
    // menus
    "settings" =>   "Inställningar",
    "logout" =>     "Logga ut",
    "save" =>       "Spara",
    "saved" =>      "Sparat!",
    "settings_saved_body" => "Dina nya inställningar har sparats!",
    "pfp" =>        "Logotyp",
    "pfp_edit" =>   "Välj logotyp",
    "ok" =>         "Okej",
    "ok0" =>        "Okej!",
    "ok1" =>        "Vad bra!",
    "ok2" =>        "Schysst!",
    "celebrate" =>  "Jippi!",
    
    "yes" =>    "Ja",
    "no" =>     "Nej",
    
    // misc
    "" =>       "[[ Kunde inte hitta den svenska texten för $1 ]]", // $1 is replaced with the text ID that could not be found in the current language (e.g. "createAcc_errors_uname_already_used")
    //"home_cs" =>"Huvudsidan kommer snart vara färdig. Här kommer du kunna se videor av användare som du har lagt till på din lista. Än så länge finns det dock ingenting på denna sida.",
    
    "login_required" =>         "Tyvärr, men du måste logga in för att kunna använda denna sida.",
    
    "interactionFail" =>        "Vi kunde inte verifiera din interaktion som en inloggad användare. Försök att logga in igen. Om du använder denna sida via en annan webbsida, vänligen använd sidan på normalt sätt.",
    
    "too_many_requests" =>      "För många personer har använt detta formulär idag. Försök igen senare.",
    "genericError"      =>      "Ett fel uppstod när formuläret skulle skickas.",
    
    "error_accidental_failure" => "Oj då!",
    "error_processing_tooktoolong" => "Det verkar som att detta tog för lång tid. Var inte orolig, det laddar fortfarande. Vi vet däremot inte när det kommer bli färdigt. Kontrollera regelbundet om det har laddat färdigt.",
    
    
    // branding
    "welcome" =>    "Välkommen till $sitename!",
    "tagline" =>    "Välkommen till $sitename, webbsidan för att dela videor om vardagsliv, animering eller spel med andra personer runt om i världen.",
    
    
    // account creation / login
    "uname_format_fail" =>  "Ditt användarnamn får bara innehålla bokstäver, siffror, bindestreck och understreck.",
    
    "email" =>      "E-postadress",
    "username" =>   "Användarnamn",
    "password" =>   "Lösenord",
    
    "createAcc_email_place" =>      "epost@exempel.se",
    "createAcc_username_place" =>   "Sojens",
    "createAcc_password_place" =>   "*******************",
    
    "createAcc_required_email" =>       "E-postadress måste fyllas i för att skapa ett konto.",
    "createAcc_required_uname" =>       "Användarnamnet kan inte vara tomt!",
    "createAcc_required_password" =>    "Du måste fylla i ett lösenord för ditt konto.",
    
    "createAcc_errors_uname_toolong" =>     "Ditt användarnamn kan inte innehålla mer än 32 tecken. Var inte orolig, du kan sätta ett alternativt namn senare, vilket kan innehålla upp till 64 tecken.",
    "createAcc_errors_password_toolong" =>  ["errors_password_toolong"],
    
    "createAcc_errors_uname_already_used" =>    ["errors_uname_already_used"],
    
    
    
    "login_email_place" =>      "epost@exempel.se",
    "login_username_place" =>   "Sojens",
    "login_password_place" =>   "****************",
    
    "login_required_email" =>       "E-postadress måste fyllas i.",
    "login_required_uname" =>       "Användarnamnet kan inte vara tomt!",
    "login_required_password" =>    "Du kan inte logga in med ett tomt lösenord.",
    
    "login_errors_uname_toolong" =>     "Ditt användarnamn innehåller mer än 32 tecken. Kom ihåg att logga in med ditt användarnamn och inte ditt alternativa namn.",
    "login_errors_password_toolong" =>  "Ditt lösenord innehåller mer än 72 tecken.",
    
    "login_error_uname" =>      "Det finns ingen användare med det namnet. Kom ihåg att logga in med ditt användarnamn och inte ditt alternativa namn.",
    "login_error_password" =>   "Lösenordet är felaktigt!",
    
    
    "loggedin" =>   "Du har blivit inloggad på ditt konto!",
    
    "gohome" =>         "Gå till huvudsidan!",
    "goconfigure" =>    "Redigera min nya profil!",
    
    // users
    "bio" => "Användarbeskrivning",
    "bio_place" => "Hej! Välkommen till min profil! Här lägger jag upp videor på saker jag gör under dagen.",
    "featured_video" => "Presenterad video",
    
    // user errors
    
    "errors_uname_toolong" =>       "Ditt användarnamn kan inte innehålla mer än 32 tecken.",
    "errors_password_toolong" =>    "Ditt lösenord kan inte innehålla mer än 72 tecken. (allvarligt?)",
    "errors_uname_already_used" =>  "Någon använder redan det användarnamnet!",
    "errors_bio_toolong" =>         "Din användarbeskrivning kan inte innehålla mer än 1024 tecken.",
    
    //configuration menus
    
    // videos
    "visit" =>          "Se profil",
    "feed_add" =>       "Lägg till i din lista",
    "feed_remove" =>    "Ta bort från din lista",
    
    "video_title_placeholder" =>        "Min video",
    "video_description_placeholder" =>  "Hej, det här är beskrivningen på min video. Denna video tog 2 månader för mig att filma, redigera och producera. Jag hoppas du tycker om att se den!",
    
    "comments_header" =>            "Kommentarer",
    
    "comment_placeholder" =>        "Skriv en kommentar",
    "comment_textfield_error" =>    "Du måste fylla i textfältet för att skriva en kommentar. Jag ser vad du försöker göra, men det kommer inte gå.",
    "comment_post" =>               "Skicka kommentar",
    "comment_reply" =>              "Svara",
    
    "comment_success_header" => "Kommentar skickad!",
    "comment_success_body" =>   "Din kommentar har laddats upp!",
    
    //uploading
    
    "title" =>              "Titel",
    "description" =>        "Beskrivning",
    "vidUpload_video" =>    "Välj video",
    
    "vidUpload_visibility_public" =>    "Tillgänglig allmänt",
    "vidUpload_visibility_unlisted" =>  "Endast tillgänglig via länk",
    "vidUpload_visibility_private" =>   "Endast tillgänglig privat",
    
    "vidUpload_required_title" =>   "Du måste fylla i en titel!",
    "vidUpload_required_video" =>   "Du måste välja en video!",
    
    "vidUpload_error_nonvideo" =>           "Du laddade inte upp en videofil!",
    "vidUpload_error_notsupported" =>       "Vi kunde inte ta reda på en del information om denna video. Ladda upp den i en annan filtyp eller försök igen.",
    
    "uploaded" =>       "Din video har laddats upp!",
    "uploaded_body" =>  "Din video har laddats upp. Vill du se den?",
    
    
    
]);

?>