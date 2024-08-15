
var DB_MODAL_EL = doc.el("#db_modal");

var MODAL_OK = (...a) => [[l("ok"), ...a]];

function SCREEN_OVERLAY(enabled) {
    
    let overlay = doc.el("#db_fullscreen_overlay");
    if(enabled)
        overlay.addc("visible");
    else
        overlay.remc("visible");
    
}

function MODAL__HIDE () {
    
    SCREEN_OVERLAY(false);
    DB_MODAL_EL.remc("visible");
    
}

async function toggleFeed(uid, button) {
    
    if(button.attr("feed_added") == "true") {
        button.innerText = l("feed_add");
        button.attr("feed_added", "false");
    } else {
        button.innerText = l("feed_remove");
        button.attr('feed_added', "true");
    }
    
    fetch("/api/accounts/feed.php", {
        method: 'POST',
        cache: 'no-cache',
        redirect: 'follow',
        referrerPolicy: 'no-referrer',
        body: new URLSearchParams("uid="+uid)
    });
    
}

function MODAL(title, text, buttons) {
    
    DB_MODAL_EL.el("h1").innerText = title;
    DB_MODAL_EL.el("span").innerText = text;
    
    DB_MODAL_EL.el("#db_modal_buttons").html("");
    buttons.forEach(function(button) {
        let bt = button;
        DB_MODAL_EL.el("#db_modal_buttons").crel("button").txt(bt[0]).on("click", async function(){
            if(!this.disabled) {
                if(bt[1] == "close")
                    MODAL__HIDE();
                
                if(bt[2] !== undefined)
                    if(bt[1] == "await") {
                        this.innerText = "...";
                        DB_MODAL_EL.els("#db_modal_buttons > button").forEach(function(me){
                            me.disabled = true;
                        });
                        await bt[2]();
                        MODAL__HIDE();
                    } if(bt[1] == "link") {
                        this.innerText = "Loading...";
                        DB_MODAL_EL.els("#db_modal_buttons > button").forEach(function(me){
                            me.disabled = true;
                        });
                        window.location.href = bt[2];
                    } else
                        if(typeof bt[2] == "function")
                            bt[2]();
                }
        });
    });
    
    SCREEN_OVERLAY(true);
    DB_MODAL_EL.addc("visible");
    
}

doc.els(".star-rating").forEach(function(el){
    
    el.els(".user-hover-stars-clickable").forEach(function(el2){
        
        el2.onclick = function(){
            let newRatio = "--ratio: "+(el2.attr("ratingValue")*100)+"%";
            if(el.el(".user-select-stars").attr("style") !== newRatio) {
                el.el(".user-select-stars").attr("style", newRatio);
                
                fetch("/api/videos/star.php", {
                    method: 'POST',
                    cache: 'no-cache',
                    redirect: 'follow',
                    referrerPolicy: 'no-referrer',
                    "body": new URLSearchParams({"v": el.attr("video"), "rating": el2.attr("ratingValue")*10})
                }).then(e => e.json()).then(function(e) {
                    
                    el.attr('style', `--ratio: ${e.output.newRatio}%`);
                    
                });
            }
            
        }
        
    })
    
});

doc.els(".vote-buttons").forEach(function(el) {
    
    el.els(".vote-button").forEach(function(el2) {
        
        el2.onclick = function(){
            if(!this.classList.contains("selected")) {
                el.els(".vote-button").forEach(function(el3){
                    
                    el3.remc("selected");
                    
                });
                
                el2.addc("selected");
                
                fetch("/api/videos/comment-vote.php", {
                    method: 'POST',
                    cache: 'no-cache',
                    redirect: 'follow',
                    referrerPolicy: 'no-referrer',
                    "body": new URLSearchParams({"comment": el.attr("comment"), "rating": el2.attr("ratingValue")})
                }).then(e => e.json()).then(function(e) {
                    
                    el.el(".vote-value").innerText = e.output.newValue;
                    
                });
            }
        }
        
    })
    
})


function fancyTimeFormat(duration) { // https://stackoverflow.com/a/11486026/11783353
    // Hours, minutes and seconds
    const hrs = ~~(duration / 3600);
    const mins = ~~((duration % 3600) / 60);
    const secs = ~~duration % 60;
  
    // Output like "1:01" or "4:03:59" or "123:03:59"
    let ret = "";
  
    if (hrs > 0) {
        ret += "" + hrs + ":" + (mins < 10 ? "0" : "");
    }
  
    ret += "" + mins + ":" + (secs < 10 ? "0" : "");
    ret += "" + secs;
  
    return ret;
}
  
if(doc.el(".videobox") !== null) {
    let vb = doc.el(".videobox");
    
    let vid = vb.el("video");
    
    doc.on("keydown", function(e) {
        
        if(e.key == " " && e.target == doc.el("body")) {
            vid.paused ? vid.play() : vid.pause();
            e.preventDefault();
        }
        
    });
    vb.ontouchstart = function(){
        
        isMobile = true;
        
    }
    
    vb.on("click", function(e) {
        if((e.target == vid || e.target == vb.el(".player-controls")) && !isMobile)
            vid.paused ? vid.play() : vid.pause();
    })
    
    vb.el(".player-left")
        .crel("a")  .attr("href", "javascript:void(0);").addc("playButton").on("click", function(){ vid.paused ? vid.play() : vid.pause(); }).prnt()
        .crel("div").addc("time");
    
    vb.el(".player-right")
        .crel("a")  .attr("href", "javascript:void(0);").addc("fullscreenButton").on("click", function(){document.fullscreenElement !== null ? document.exitFullscreen() : vb.requestFullscreen()}).styl("backgroundImage", "url('/img/icons/fullscreen.svg')");
        
        
    setInterval(() => {
        vb.attr("style", "--progress: "+(vid.currentTime / vid.duration)+";");
        vb.el(".time").html("").txt(`${fancyTimeFormat(Math.floor(vid.currentTime))} / ${fancyTimeFormat(Math.floor(vid.duration))}`);
        
        vb.el(".playButton").style.backgroundImage = "url('/img/icons/"+(vid.paused ? "play" : "pause")+".svg')";
        
    }, 100);
    
    vid.on("pause", function(){
        
        vb.remc("nocontrols");
        
    });
    
    var isMobile = false;
    var hideControlsTimeout;
    vb.onmousemove = vid.onplaying = vb.ontouchstart = function(e){
        if(e.type == "touchstart")
            isMobile = true;
        
        vb.remc("nocontrols");
        clearTimeout(hideControlsTimeout);
        if((e.type !== "mousemove" || e.target == vid || e.target == vb.el(".player-controls")) && !vid.paused)
            hideControlsTimeout = setTimeout(function(){vb.addc("nocontrols")}, isMobile ? 3000 : 1000);
        
    }
    
    
    vb.el(".progressbar").onmousedown = 
    vb.el(".progressbar").ontouchstart = 
    function(e){
        let toRePlay = vid.paused;
        
        e.preventDefault();
        
        vid.pause();
        function mouse(pos, click = false) {
            pos.preventDefault();
            
            let progRect = vb.el(".progressbar").getBoundingClientRect();
            let prog = Math.min(1, Math.max(0, (pos.touches ? pos.touches[0].clientX : pos.clientX) - progRect.left) / progRect.width);
            vb.attr("style", "--progress: "+(prog)+";");
            vid.currentTime = prog * vid.duration;
            
        }
        
        window.onmousemove = window.ontouchmove = mouse;
        
        window.onmouseup = window.ontouchend = function(){window.onmousemove = null; window.ontouchmove = null; window.ontouchend = null; window.onmouseup = null; if(!toRePlay) vid.play(); };
        
    };
    
}

if(window.location.pathname.startsWith("/v/") && doc.el("video") !== null && doc.classList.contains("logged-in")) {
    
    let vid = doc.el("video");
    var lastUpdated = vid.currentTime;
    
    
    function updateVideoTime() {
        
        fetch("/api/videos/watchTime.php"+window.location.search, {
            
            method: "POST",
            cache: "no-cache",
            redirect: "follow",
            referrerPolicy: "no-referrer",
            "body": new URLSearchParams({"video": vid.attr("videoID"), "watchTime": vid.currentTime/vid.duration})
            
        });
        
        lastUpdated = vid.currentTime;
        
    }
    
    setInterval(function() {
        
        if(Math.abs(lastUpdated-(vid.currentTime)) > 2)
            updateVideoTime();
        
    }, 10000);
    
    vid.onpause = updateVideoTime;
    vid.onseeked = updateVideoTime;
    //window.onmouseout = updateVideoTime;
    
    if(vid.duration && vid.duration > 10)
        vid.currentTime = vid.duration*vid.attr("watchTime");
    else
        vid.onloadedmetadata = function(){
            
            vid.currentTime = vid.duration*vid.attr("watchTime");
            
        };
    
}

document.querySelectorAll(".time_tobe_localized").forEach(function(e){
    
    e.innerText = new Date(e.innerText).toLocaleString(getCookie("language"));
    
})


// ban pork





