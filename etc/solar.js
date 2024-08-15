doc = document.documentElement;


function getReq(theUrl, callback) {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() { 
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
            callback(xmlHttp.responseText);
    };
    xmlHttp.open("GET", theUrl, callback === false ? false : true); // true for asynchronous 
    xmlHttp.send(null);
    
    // Thanks for the help, StackOverflow!
}

function postReq(theUrl, post, callback, type) {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() { 
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
            callback(xmlHttp.responseText);
    };
    xmlHttp.open("POST", theUrl, callback === false ? false : true); // true for asynchronous 
    xmlHttp.setRequestHeader('Content-Type', type);
    
    xmlHttp.send(post);
    
    // Thanks for the help, StackOverflow!
}

String.prototype.splitAtFirst = function(splitter = "") {
    if(this.includes(splitter))
        return [this.substr(0,this.indexOf(splitter)), this.substr(this.indexOf(splitter)+splitter.length)];
    else
        return [this];
    
    // Thanks for the help, StackOverflow!
    
};

String.prototype.splitAtLast = function(splitter = "") {
    if(this.includes(splitter))
        return [this.substr(0,this.lastIndexOf(splitter)), this.substr(this.lastIndexOf(splitter)+splitter.length)];
    else
        return [this];
    
    // Thanks for the help, StackOverflow!
    
};

function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  let expires = "expires="+ d.toUTCString();
  document.cookie = encodeURIComponent(cname) + "=" + encodeURIComponent(cvalue) + ";" + encodeURIComponent(expires) + ";path=/";
}

function getCookie(cname) {
  let name =  encodeURIComponent(cname) + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) === 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

Element.prototype.el = function(n) {
    return this.querySelector(n);
};
Element.prototype.els = function(n) {
    return this.querySelectorAll(n);
};

Element.prototype.attr = function(n, d) {
    if(typeof d !== "undefined"){
        this.setAttribute(n,d);
        return this;
    } else {
        return this.getAttribute(n);
    }
};
Element.prototype.styl = function(n, d) {
    this.style[n] = d;
    return this;
};
Element.prototype.addc = Element.prototype.addC = Element.prototype.addclass = Element.prototype.addClass = function(n) {
    this.classList.add(n);
    return this;
};
Element.prototype.remc = Element.prototype.remC = Element.prototype.removeclass = Element.prototype.removeClass = function(n) {
    this.classList.remove(n);
    return this;
};
Element.prototype.CrEl = Element.prototype.crEl = Element.prototype.crel = Element.prototype.cr = Element.prototype.create = function(n){
    var s = document.createElement(n);
    this.appendChild(s);
    return s;
};
Element.prototype.prnt = function(){
    return this.parentElement;
};
Element.prototype.txt = function(n, d){
    var a = document.createTextNode("Error! Couldn't get text properly.");
    if((d === true)) {
        a=document.createTextNode(n+"\n");
    } else {
        a=document.createTextNode(n);
    }
    this.appendChild(a);
    
    return this;
};
Element.prototype.html = function(h){
    this.innerHTML = h;
    return this;
};

Element.prototype.on = function(o, f, e){
    
    this.addEventListener(o, f, e);
    return this;
    
};

Element.prototype.sid = function(id){ // set ID
    
    this.id = id;
    return this;
    
};

function htmlspecialchars(text) {
    
    e = doc.crel("htmlspc").html("");
    o = e.txt(text).innerHTML;
    e.remove(); 
    return o;
    
}

function unhtmlspecialchars(text) {
    
    e = doc.crel("unhtmlspc").html("");
    o = e.html(text).innerText;
    e.remove(); 
    return o;
    
}
/*
function markup(text){
    html = htmlspecialchars(text);
    try {
        html = html.replace(/(?<!\\)\`(.*?)(?<!\\)\`/gm, function(match, p1){
            
            p1 = unhtmlspecialchars(p1);
            p1 = p1.replace(/[\u0000-\u9999]/gim, function(i) {
                return '&#'+i.charCodeAt(0)+';';
            });
            
            return "<code>"+p1+"</code>";
            
            
        });
        html = html.replace(/(?<!\\)\*(?<!\\)\*(.*?)(?<!\\)\*(?<!\\)\*\/gm, '<b>$1</b>');
        html = html.replace(/(?<!\\)\*(.*?)(?<!\\)\*\/gm, '<i>$1</i>');
        html = html.replace(/(?<!\\)\_(?<!\\)\_(.*?)(?<!\\)\_(?<!\\)\_/gm, '<u>$1</u>');
        html = html.replace(/(?<!\\)\~(?<!\\)\~(.*?)(?<!\\)\~(?<!\\)\~/gm, '<strike>$1</strike>');
        
        html = html.replace(/(((https?:\/\/)|(www\.))[^\s]+)/g, function (url) {
            
            var hyperlink = url;
            
            if (!hyperlink.match('^https?:\/\/')) { 
                hyperlink = 'http://' + hyperlink;
            }
            
            return '<a href="' + hyperlink + '" target="_blank" rel="noopener noreferrer">' + url + '</a>';
        });
        
        html = html.replace(/\\\*\/g, "*");
        html = html.replace(/\\\~/g, "~");
        html = html.replace(/\\\`/g, "`");
        
        //html = twemoji.parse(html, {folder: 'svg',ext:".svg"});
    } catch(err) {
        
        console.error("Error occured while parsing markup. Reverting to plaintext...");
        
        html = htmlspecialchars(text)
        
    }
    return html;
}*/


function random(min, max) {
  return Math.floor(Math.random() * (max - min + 1) ) + min;
}

//ABOVE THIS LINE IS FROM: SQ.js by Sojaquad (Updated in 2021)
