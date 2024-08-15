<?php
/*
if($_COOKIE["a"] !== "GreenBeans") {
    ?>
    
    <video src="https://lunarsphere.net/Orange.webm" loop controls style="left: 50vw; top: 50vh; transform: translate(-50%, -50%); position: fixed; "></video>
    
    <?php
    die();
}*/

include "database.php";
#include "info.php";

$primary_site = "https://dynambu.lunarsphere.net";

$sitename = "Dynambu";
$path = "/var/www/www/dynambu";
$path = "/var/www/www/dynambu_data";

include "languages/_INIT.php";
include("languages/".$selected_language.".php");

function l($value, ...$replacers) {
    
    global $l;
    
    if(isset($l[$value])) {
        $v = $l[$value];
        
        $i = 0;
        foreach($replacers as $replacer) {
            $i ++;
            
            $v = str_replace('$'.$i, $replacer, $v);
            
        }
    } else
        $v = str_replace("$1", $value, $l[""]);
    
    return $v;
    
}

/*
$l = $lang = [
    
    "" => "[[ Ye couldn't find yer text! ]]",
    "cs" => "Coming soon",
    "login" => "Loggy",
    "create_acc" => "Walk the plank!",
    "email" => "Message-in-a-bottle:",
    "username" => "Yer 'fake name':",
    "password" => "Secret code:",
    "createAcc" => "Walk the plank!",
    "welcome" => "Ye be Dynambu!",
    "tagline" => "This 'ere is Dynambu, the thingy for puttin' yer face on that 'inter-net'.",
    "loggedin" => "Ye've walked the plank!"
    
];
*/

function login_link() {
    
    $ref = $_SERVER["REQUEST_URI"];
    return "/account/login/?ref=".urlencode($ref);
    
}

function form_start($action, $actions) {
    
    if(!isset($actions["options"]))
        $actions["options"] = [];
    
    if(!isset($actions["options"]["visible"]))
        $actions["options"]["visible"] = true;
    
    ?>
<form <?php if(!isset($actions["method"])) { ?> method="POST" <?php } ?> action="<?= $action ?>" 

<?= $actions["options"]["id"] ? "id='".htmlspecialchars($actions['options']['id'], ENT_QUOTES)."'" : "" ?>
<?= $actions["options"]["visible"] ? 'visible=true' : 'visible=false'?><?php

foreach($actions as $a => $b) {
    
    if(is_array($b))
        foreach($b as $c => $d) {
            
            echo " ".$a."_".$c."='".(is_array($d) ? json_encode($d) : htmlspecialchars($d, ENT_QUOTES))."'";
            
        }
    else
        echo " $a='".$b."'";

}

?>>
    <?php
    
}

function input($o) {
    
    $is_there = function ($key, $output = "", $otherwise = "") use ($o) {
        
        if(!is_array($output))
            $output = [$key, $output];
        
        if(!is_array($otherwise))
            $otherwise = [$key, $otherwise];
        
        if(isset($o[$key]))
            return $output[0] == false ? htmlspecialchars($output[1]) : $output[0]."='".htmlspecialchars($output[1])."'";
        else
            return !empty($otherwise[1]) ? $otherwise[0]."='".htmlspecialchars($otherwise[1])."'" : "";
        
    };
    $inputID = "INPUT_".rand(0, 100).microtime(true);
    if($o === "submit")
        $o = ["type" => "submit"];
        
    ?>
    
    <div class="input_container" <?= ($o["type"] == "submit") ? "inputName='submit_button'" : $is_there("name", ["inputName", $o["name"]]) ?>>
        <?php if(isset($o["label"])) {?>
        <label for="<?= $inputID ?>"<?= $o["type"] == "file" ? " class='file-button'" : "" ?>><?= htmlspecialchars($o["label"]) ?></label>
        <?php if($o["type"] !== "file") { ?><br><?php }?>
        <?php }?>
        
        <?php
        if($o["type"] == "textarea") {
            ?><textarea <?php 
        } else {
            ?><input    <?php
        }
        
        ?>
        type="<?= $o["type"] ?>" <?php if($o["type"] !== "file") { ?><?= $is_there("value", $o["value"]) ?> <?= $is_there("placeholder", $o["placeholder"]) ?><?php } else {?>style='width: 0;height: 0;padding: 0;border: none;'<?php }?> <?= isset($o["required"]) && $o["required"] == false ? "" : "required" ?> <?= $is_there("name", $o["name"]) ?> id="<?= $inputID ?>"><?php if($o["type"] == "textarea") { if(isset($o["value"])) echo htmlspecialchars($o["value"]) ?></textarea><?php } ?>
        <div class="error"></div>
    </div>
    
    <?php
    
}

function dropdown($name, $values) {
    
    ?>
    <div class="input_container" inputName="<?= $name ?>">
        <select name="<?= $name ?>">
            <?php
    foreach($values as $key => $value) {
        
        ?><option value="<?= $key ?>"> <?= $value ?></option><?php
        
    }
    ?>
        </select>
    </div><?php
    
}

function captcha(){
    
    //setcookie("captcha")
    //input(["type" => "text"])
    
}

function link_button($text, $action) {
    
    ?><a href="<?= htmlspecialchars($action) ?>"><button><?= htmlspecialchars($text) ?></button></a><?php
    
}

function p($text) {
    
    ?><p><?= htmlspecialchars($text) ?></p><?php
    
}
function text($text) {
    
    echo htmlspecialchars($text);
    
}

function form_end() {
    
    ?></form><?php
    
}

function buttonbox_start() {
    
    ?><div class="buttonbox"><?php
    
}

function buttonbox_end() {
    
    ?></div><?php
    
}

function div_open($options = []) {
    ?><div <?php 
    
    foreach($options as $op => $val) {
        
        ?><?= $op."=" ?><?= '"'.htmlspecialchars($val, ENT_QUOTES).'"' ?><?php
        
    }
    
    ?>><?php
}
function div($options = []) {
    div_open($options);
    div_close();
}

function div_close() {
    ?></div><?php
}

function link_open($options = []) {
    
    ?><a <?php 
    
    foreach($options as $op => $val) {
        
        ?><?= $op."=" ?><?= '"'.htmlspecialchars($val, ENT_QUOTES).'"' ?><?php
        
    }
    
    ?>><?php
    
}
function a($options = []) {
    link_open($options);
    text($options["text"]);
    link_close();
}

function link_close() {
    ?></a><?php
}

function query_if_necessary($idOrData, $query, $extraQueryArgs = []) {
    
    if(is_array($idOrData))
        return $idOrData;
    else {
        
        $q = db_query($query, array_merge([$idOrData], $extraQueryArgs));
        if($q->rowCount() > 0)
            return $q->fetch(PDO::FETCH_ASSOC);
        else
            return false;
        
    }
    
}

function showPlayer($v) {
    
    global $loggedin, $userid;
    
    ?>
    <div class="videobox">
        <video src="/api/videos/watch.php?v=<?= htmlspecialchars($v, ENT_QUOTES) ?>" <?= $loggedin ? 'watchTime="'.db_query("SELECT COALESCE(amount,'0') AS watchTime FROM watched WHERE user = ? AND video = ? AND amount < 0.95", [$userid, $v])->fetch(PDO::FETCH_ASSOC)["watchTime"].'"' : "" ?> videoID="<?= htmlspecialchars($v, ENT_QUOTES) ?>"></video>
        <div class="player-controls">
            <div class="progressbar"></div>
            <div class="player-buttons">
                <div class="player-left"></div>
                <div class="player-right"></div>
            </div>
        </div>
    </div>
    <?php
    
}

function showVideo($v, $type = "thumbnail") {
    
    global $loggedin, $userid;
    $v = query_if_necessary($v, "SELECT * FROM videos WHERE id = ?");
    $href = "/v/".htmlspecialchars($v["id"], ENT_QUOTES)."/";
    ?>
    <div class="video<?= (!canShowVideo($v) ? " unlisted" : "") ?>" type="<?= $type ?>">
        <a class="v-thumbnail" href="<?= $href ?>">
            <img src="/api/videos/thumbnail.php?v=<?= $v["id"] ?>" loading="lazy" />
            <div class="v-watchTime" style="--watchTime: <?= ($loggedin ? db_query("SELECT amount FROM watched WHERE video = ? AND user = ? AND amount < 0.95", [$v["id"], $userid])->fetch(PDO::FETCH_ASSOC)["amount"] ?: '0' : '0') ?>;"></div>
        </a>
        <a class="v-title" href="<?= $href ?>"><?= htmlspecialchars($v["title"]) ?></a>
        <div class="v-creator"><?= showUser($v["creator"]) ?></div>
    </div>
    <?php
    
}

function canShowVideo($v) {
    
    global $userdata;
    $v = query_if_necessary($v, "SELECT * FROM videos WHERE id = ?");
    if(db_query("SELECT COUNT(id) AS count FROM users WHERE id = ? AND blocked IS NOT NULL", [$v["creator"]])->fetch(PDO::FETCH_ASSOC)["count"] > 0)
        return false;

    return $v["visibility"] == 0;
    
}

function canDisplayVideo($v) {
    
    global $userid, $loggedin, $userdata;
    $v = query_if_necessary($v, "SELECT * FROM videos WHERE id = ?");
    return $v["visibility"] < 2 || ($loggedin && $userid == $v["creator"]) || $userdata["class"] == "ADMINISTRATOR";
    
}


function showUser($id, $addID = null, $options = []) {
    
    //if(isset($options["showFeedButton"]) && isset)
    
    $u = query_if_necessary($id, "SELECT * FROM users WHERE id = ?");
    
    if($u !== false) {
        ?>
        <div class="user" <?= $addID !== null ? "id='$addID'" : "" ?>>
            <a href='/u/<?= htmlspecialchars(strtolower($u["username"]), ENT_QUOTES) ?>/'>
                <div class="u-pfp" style="<?= ($u["pfp"] !== null) ? "--img: url('/api/accounts/getLogo.php?id=".$u["id"]."')" : "--color: ".round(base_convert(strtolower($u["id"]), 36, 10) / 1E20) ?>"></div>
                <div class="u-name"><?= htmlspecialchars($u["username"]) ?></div>
            </a>
            <?php
            
            global $loggedin, $userid;
            if(isset($options["showFeedButton"]) && $options["showFeedButton"] == true && $loggedin && $userid !== $u["id"]) {
                
                $inFeed = db_query("SELECT * FROM feed WHERE user = ? AND following = ?", [$userid, $u["id"]])->rowCount() > 0;
                ?><button class="addToFeed user_add2feed_button" onclick='toggleFeed("<?= $u["id"] ?>", this);' feed_added="<?= $inFeed ? "true" : "false" ?>"><?= $inFeed ? l("feed_remove") : l("feed_add") ?></button><?php
                
            }
            
            ?>
        </div>
        <?php
        
        if(isset($options["extraText"])) {
            ?>
            <div class="u-extra"><?= htmlspecialchars($options["extraText"]) ?></div>
            <?php
        }
        
        ?>
        <?php
    } else {
        ?>{ Account Deleted }<?php
    }
    
}

function getFeed($count) {
    
    global $userid, $primary_site;
    return db_query("SELECT 
        videos.id,
        videos.title,
        videos.description,
        videos.visibility,
        videos.creator,
        (SELECT username FROM users WHERE id = videos.creator) AS creator_username, CONCAT('$primary_site/v/', videos.id, '/') AS link,
        CONCAT('$primary_site/api/videos/thumbnail.php?v=', videos.id) AS thumbnail,
        AVG(ratings.value) AS stars,
        SUM(ratings.value) AS stars_total, 
        MAX(COALESCE(watched.amount, 0)) AS watchedAmount
    FROM videos
    LEFT JOIN watched
    ON 
        videos.id = watched.video AND
        watched.user = :userid1
    LEFT JOIN ratings 
    ON 
        ratings.video = videos.id
    WHERE
        (videos.id = watched.video OR watched.amount IS NULL) AND 
        (watched.amount = 0 OR watched.amount IS NULL) AND 
        videos.creator IN (SELECT following FROM feed WHERE user = :userid2) AND 
        (watched.user = :userid3 OR (watched.amount IS NULL)) AND
        videos.creator NOT IN (SELECT id FROM users WHERE blocked IS NOT NULL)
    GROUP BY videos.id 
    ORDER BY videos.creation DESC
    LIMIT :count", 
    array("userid1" => $userid, "userid2" => $userid, "userid3" => $userid, "count" => $count))->fetchAll(PDO::FETCH_ASSOC);
    
}

function videos_search($query, $limit = 20) {
    
    global $primary_site;
    return db_query(
    "SELECT 
        videos.id,
        videos.title,
        videos.description,
        videos.visibility,
        videos.creator,
        (SELECT username FROM users WHERE id = videos.creator) AS creator_username, CONCAT('$primary_site/v/', videos.id, '/') AS link,
        CONCAT('$primary_site/api/videos/thumbnail.php?v=', videos.id) AS thumbnail,
        AVG(ratings.value) AS stars,
        SUM(ratings.value) AS stars_total
    FROM videos 
    LEFT JOIN ratings ON ratings.video = videos.id 
        WHERE (title LIKE ?
        OR description LIKE ?
        OR videos.creator IN (SELECT id FROM users WHERE username LIKE ?))
        AND videos.creator NOT IN (SELECT id FROM users WHERE blocked IS NOT NULL)
    GROUP BY videos.id
    ORDER BY stars_total DESC
    LIMIT ?",
    [
        '%'.$_GET["q"].'%', 
        '%'.$_GET["q"].'%', 
        '%'.$_GET["q"].'%', 
        $limit
    ]);
    
}

/*
function getFeed($count) {
    
    global $userid;
    return db_query("SELECT videos.*, COALESCE(watched.amount,0) AS amountWatched, COALESCE(watched.video, videos.id) AS watchedVideo, COALESCE(watched.user, ?) AS watchedUser FROM videos,watched WHERE videos.id = watchedVideo AND videos.creator IN (SELECT following FROM feed WHERE user = ?) AND watchedUser = ? ORDER BY videos.creation DESC LIMIT ?", [$userid, $userid, $userid, $count])->fetchAll(PDO::FETCH_ASSOC);
    
}
*/

function showComment($id, $layer = 0) {
    
    ?><div class="comment-tree-layer"><?php
    
    DISPLAY_COMMENT($id);
    
    $q = db_query("SELECT * FROM comments WHERE replyingto = ? ORDER BY creation DESC", [$id])->fetchAll(PDO::FETCH_ASSOC);
    foreach($q as $v) {
        
        showComment($v["id"], $layer+1);
        
    }
    
    ?></div><?php
    
}
function DISPLAY_COMMENT($id) {
    
    global $loggedin, $userid;
    
    $c = query_if_necessary($id, "SELECT * FROM comments WHERE id = ?");
    $id = $c["id"];
    ?>
    <div class="comment">
        <?php
        showUser($c["creator"]);
        ?>
        
        <div class="comment-text"><?= htmlspecialchars($c["text"]) ?></div>
        
        <div class="comment-actions">
            <?php
            
            if($loggedin) {
            
            ?>
                <button onclick="doc.el('#replyForm-<?= $id ?>').attr('visible', 'true')"><?= l("comment_reply") ?></button>
            <?php
            if($c["creator"] !== $userid) {
                
                $selectedVote = db_query("SELECT value FROM comments_votes WHERE comment = ? AND creator = ?", [$c["id"], $userid]);
                
                if($selectedVote->rowCount() > 0)
                    $selectedVote = $selectedVote->fetch(PDO::FETCH_ASSOC)["value"];
                else
                    $selectedVote = 0;
                
            }
            
            }
            ?>
            <div class="vote-buttons" comment="<?= $id ?>">
                <?php if($loggedin && $c["creator"] !== $userid) {?>
                    <button class="vote-button <?= $selectedVote ==  "1" ? "selected" : "" ?>" ratingValue=1 >&uarr;</button>
                <?php } ?>
                <div class="vote-value"><?= db_query("SELECT COALESCE(SUM(value),0) AS rating FROM comments_votes WHERE comment = ?", [$c["id"]])->fetch(PDO::FETCH_ASSOC)["rating"] ?></div>
                <?php if($loggedin && $c["creator"] !== $userid) {?>
                    <button class="vote-button <?= $selectedVote == "-1" ? "selected" : "" ?>" ratingValue=-1>&darr;</button>
                <?php }?>
            </div>
        </div>
        <?php
        
        if($loggedin) {
        
        ?>
            <div class="comment-tree-layer">
                <?php
                
                
                form_start("/api/videos/comment.php?v=".$c["video"]."&replyingTo=".$id, 
                [
                    "success" => [
                        "title" => l("comment_success_header"),
                        "text" => l("comment_success_body"),
                        "buttons" => [
                                
                            [l("ok1"), "close"],
                            
                        ]
                    ],
                    
                    "options" => [
                        
                        "clearOnSubmit" => true,
                        "hideOnSubmit" => true,
                        "id" => "replyForm-".$id,
                        "visible" => false,
                        
                    ]
                ]
                );
                
                
                input(["type" => "textarea",    "name" => "comment",          "placeholder" => l("comment_placeholder")]);
                input(["type" => "submit",      "value" => l("comment_post")]);
                
                form_end();
                
                ?>
            </div>
        <?php
        
        }
        
        ?>
    </div>
    <?php
    
    
}

$ip =        $_SERVER["REMOTE_ADDR"];
$useragent = $_SERVER['HTTP_USER_AGENT'];

function validate_username($username) {
    
    if(strlen($_POST["uname"]) > 32)
        return l("errors_uname_toolong");
    if(db_query("SELECT * FROM users WHERE username = ?", [$_POST["uname"]])->rowCount() > 0)
        return l("errors_uname_already_used");
        
    return true;
}

$loggedin = false;
$safeInteraction = false;
$LOGGED_IN_AS = 0;
$settings = [];
$hasToken = false;
$checkInteraction = false;
if(isset($_GET["login"]))
    $hasToken = $_GET["login"];
if(isset($_COOKIE["login"])) {
    $hasToken = $_COOKIE["login"];
    $checkInteraction = true;
}
if($hasToken) {
    
    
    $e = db_query("SELECT * FROM tokens WHERE token = ?", [$hasToken]);
    if($e->rowCount() > 0) {
        $userid = $e->fetch(PDO::FETCH_ASSOC)["user"];
        $userdata = db_query("SELECT * FROM users WHERE id = ?", [$userid])->fetch(PDO::FETCH_ASSOC);
        $username = $userdata["username"];
        
        $loggedin = true;
        
        if(!$checkInteraction || (isset($_COOKIE["interaction"]) && $_COOKIE["interaction"] == $_COOKIE["login"]))
            $safeInteraction = true;
        
        define("DEFAULT_SETTINGS", [
            
            [
                "id" => "bio",
                "name" => l("bio"),
                "type" => "text",
                "inputType" => "textarea",
                "placeholder" => l("bio_place"),
                "validate" => function($e){
                    
                    if(strlen($e) > 1024)
                        return l("errors_bio_toolong");
                    
                    return true;
                    
                }
            ],
            
        ]);
        
        $settings = DEFAULT_SETTINGS;
        
        
        foreach($settings as $setting => $vava) {
            
            $settings[$setting]["value"] = $userdata[$vava["id"]];
            
        }
        
    }
}

function require_login() {
    
    global $loggedin;
    if(!$loggedin) {
        
        http_response_code(401);
        head(l("login_required_header"), ["pagetype" => "mini", "centered" => true]);
        
        p(l("login_required"));
        
        buttonbox_start();
        link_button(l("gohome"), "/");
        link_button(l("login"), login_link());
        buttonbox_end();
        
        foot();
        
        die();
        
    }
    
}

function forbidden() {
    
    http_response_code(403);
    head(l("403"), ["pagetype" => "mini", "centered" => true]);
    
    p(l("403_body_text"));
    
    buttonbox_start();
    link_button(l("gohome"), "/");
    link_button(l("login"), login_link());
    buttonbox_end();
    
    foot();
    die();
    
}

function require_class($class) {
    
    global $loggedin, $userid;
    if(!$loggedin || db_query("SELECT * FROM users WHERE id = ? AND class = ?", [$userid, $class])->rowCount() <= 0) {
        
        forbidden();
        
    }
    
}

function pagenotfound() {
    
    http_response_code(404);
    head(l("404"), ["pagetype" => "tiny", "centered" => true]);
    
    p(l("404"));
    
    buttonbox_start();
    link_button(l("gohome"), "/");
    buttonbox_end();
    
    foot();
    die();
    
}

function api_require_login() {
    global $loggedin, $safeInteraction;
    if(!$loggedin || !$safeInteraction) {
        api_response(API_AUTH_ERROR);
    }
}
function api_require_class($class) {
    global $loggedin, $userid;
    if(!$loggedin || db_query("SELECT * FROM users WHERE id = ? AND class = ?", [$userid, $class])->rowCount() <= 0) {
        
        $err = API_AUTH_ERROR;
        $err["errors"]["genericError"] = l("403_body_text");
        api_response($err);
        
    }
}


function login_user($id) {
    global $ip, $useragent;
    $token = md5(random_int(10000,99999).password_hash(microtime(true), PASSWORD_DEFAULT)).md5(random_int(10000,99999).password_hash(microtime(true), PASSWORD_DEFAULT)).md5(random_int(10000,99999).password_hash(microtime(true), PASSWORD_DEFAULT));
    setcookie("login", $token, [
        "expires" => (time()+(60*60*24*7*31*12)),
        "path" => "/",
        "secure" => true,
        "httponly" => true,
        "samesite" => "None"
    ]);
    setcookie("interaction", $token, [
        "expires" => (time()+(60*60*24*7*31*12)),
        "path" => "/",
        "secure" => true,
        "httponly" => true,
        "samesite" => "Strict"
    ]);
    db_query("INSERT INTO tokens (token, user, ip, agent) VALUES (?,?,?,?)", [$token, $id, $ip, $useragent]);
    return $token;
    
}

function api_success($output = []) {
    
    $o = API_SUCCESS_DEFAULT;
    $o["output"] = $output;
    api_response($o);
    
}

function api_error($errors) {
    
    $err = API_REQUEST_ERROR;
    $err["errors"] = $errors;
    api_response($err);
    
}

function api_response($json, $status = true) {
    if($status)
        if($json["requesterror"])
            http_response_code(400);
        if(!$json["authorized"])
            http_response_code(401);
        else if($json["success"] == false)
            http_response_code(400);
    
    header("Content-Type: application/json");
    die(json_encode($json));
    
}


function randID() {
    
    return md5(random_int(10000,99999).password_hash(microtime(true), PASSWORD_DEFAULT)).md5(random_int(10000,99999).password_hash(microtime(true), PASSWORD_DEFAULT)).md5(random_int(10000,99999).password_hash(microtime(true), PASSWORD_DEFAULT));
    
}

function randID_short() {
    
    return substr(base64_encode(md5(random_int(0,2147483647).microtime(true))), 0, 15);
    
}


function api_require($vars, $throw_error = true) {
    global $API_REQUIRE_FOUND_NONEXISTANT;
    
    $ae = 0;
    $API_REQUIRE_FOUND_NONEXISTANT = [];
    foreach($vars as $a => $error) {
        
        if(
            (str_starts_with($a, "!F:") ? (isset($_FILES[explode("!F:", $a)[1]])) : (isset($_POST[$a]) && !empty(trim($_POST[$a])))) ||
            (str_starts_with($a, "g.") ? (isset($_GET[explode("g.", $a)[1]])) : true)
        ) {
            
            $ae++;
            
        } else {
            
            $API_REQUIRE_FOUND_NONEXISTANT[$a] = $error;
            
        }
        
    }
    
    if($ae === count($vars)) {
        return true;
    } else {
        $err = API_REQUEST_ERROR;
        $err["errors"] = $API_REQUIRE_FOUND_NONEXISTANT;
        if($throw_error)
            api_response($err);
        else
            return false;
    }
    
};

function api_get_file($filename) {
    
    global $datapath;
    $fn = explode("::", $filename);
    
    $name = $fn[0];
    $key  = $fn[1];
    
    $e = db_query("SELECT * FROM uploads WHERE id = ?", [$name]);
    if($e->rowCount() == 0)
        api_error(["genericError" => l("genericError")]);
    $upload = $e->fetch(PDO::FETCH_ASSOC);
    if(!password_verify($key, $upload["passkey"]))
        api_error(["genericError" => l("genericError")]);
    
    $fpath = "$datapath/".$upload["file"];
    
    if(!file_exists($fpath))
        api_error(["genericError" => l("genericError")]);
    
    $output = [
        "id"    => $upload["id"],
        "path"  => $upload["file"],
        "type"  => mime_content_type($fpath),
        "ext"   => end(explode(".", $fpath)),
    ];
    
    return $output;
    
}

define("API_REQUEST_ERROR",   ["success" => false, "authorized" => true,  "requesterror" => true,  "errors" => [], "output" => []]);
define("API_AUTH_ERROR",      ["success" => false, "authorized" => false, "requesterror" => false, "errors" => [
    "genericError" => l("interactionFail")
], "output" => []]);
define("API_ERROR_DEFAULT",   ["success" => false, "authorized" => true,  "requesterror" => false, "errors" => [], "output" => []]);
define("API_SUCCESS_DEFAULT", ["success" => true,  "authorized" => true,  "requesterror" => false, "errors" => [], "output" => []]);


define("REPORT_TYPES", [
    "SUGGESTION" => "",
    "VIDEO" => [
        "link" => "/v/$1/",
        "query" => "SELECT * FROM videos WHERE id = ?",
        "action" => function($id, $action, $reason) {
            
            if($action == "block")
                db_query("UPDATE videos SET visibility = 2, blocked = ? WHERE id = ?", [$reason, $id]);
            if($action == "reinstate")
                db_query("UPDATE videos SET visibility = 0, blocked = '' WHERE id = ?", [$id]);
            
        }
    ],
    "USER" => ["link" => "/u/$1/", "query" => "SELECT * FROM users WHERE id = ?"], //, "action" => "UPDATE users SET  = ?, reason = ? WHERE id = ?"
]);


include "headers.php";


$primary_site = "https://dynambu.lunarsphere.net";

$sitename = "Dynambu";
$path = "/var/www/www/dynambu";
$datapath = "/var/www/www/dynambu_data";


if($userdata["blocked"] !== null && $_SERVER['REQUEST_URI'] !== "/logout/") {
    
    head(l("blocked"), ["pagetype" => "full"]);
    ?>
    
    <p><span style="color: red;">Your account has been blocked.</span></p>
    
    <p>Reason:</p>
    <pre><?=
        
        htmlspecialchars($userdata["blocked"])
        
        ?></pre>
    <p><a href="/logout/">Log out</a></p>
    
    <?php
    foot();
    die();
    
}

?>
