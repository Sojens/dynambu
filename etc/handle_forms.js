

const maxFileSize = 1000000000;
const maxChunkSize = 50000000;

function uploadTempFile(file, fileEl) {
    
    return new Promise(async (res) => {
        if(file.size > maxFileSize) {
            
            res("error:File too large!");
            
        } else {
            let chunks = Math.ceil(file.size / maxChunkSize);
            let chunkSize = Math.ceil(file.size / chunks);
            
            let a = await fetch("/api/files/createUpload.php", {
                method: 'POST',
                cache: 'no-cache',
                redirect: 'follow',
                referrerPolicy: 'no-referrer',
                headers: {"Content-Type": "application/x-www-form-urlencoded"},
                body: `uploading=${chunks}&chunkSize=${chunkSize}`, // body data type must match "Content-Type" header
            });
            
            let keys = await a.json();
            let uploads = [];
            
            let completed = 0;
            let targetProgress = 0;
            let currentProgress = 0;
            let timeSinceLast = Date.now();
            let loadUpdater = setInterval(function(){
                
                currentProgress = currentProgress+((targetProgress-currentProgress)/100);
                fileEl.attr("style", "--uploadProgress: "+currentProgress);
                
                timeSinceLast = Date.now();
            });
            
            for(let c=0; c<chunks; c++) {
                
                uploads[c] = 0;
                
                let offset = chunkSize*c;
                
                let chunk = file.slice(offset, offset+chunkSize);
                let data = new FormData();
                
                data.append("id", keys.output.id);
                data.append("passkey", keys.output.passkey);
                data.append("chunk", c+1);
                data.append("chunkData", chunk);
                
                let sentTimes = 1;
                
                function trySending() {
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', "/api/files/uploadPartial.php");
                    
                    xhr.upload.addEventListener("progress", (event) => {
                        if (event.lengthComputable) {
                            uploads[c] = event.loaded / event.total;
                            let loaded = (uploads.reduce((a, b) => a + b) / chunks);
                            
                            targetProgress = loaded;
                            
                            if(loaded == 1)
                                fileEl.addc("input_loading");
                            
                        }
                    });
                    
                    xhr.addEventListener("loadend", () => {
                        
                        if(xhr.status !== 200 && xhr.status !== 400) {
                            if(sentTimes > 10)
                                res("error:Error uploading file.");
                            else
                                trySending();
                        } else {
                            completed++;
                            if(completed == chunks) {
                                fileEl.attr("style", "");
                                fileEl.remc("input_loading");
                                clearInterval(loadUpdater);
                                res(keys.output.id+"::"+keys.output.passkey);
                            }
                        }
                    });
                    
                    xhr.send(data);
                    
                }
                trySending();
            }
            
            
        }
    })
}

Array.prototype.forEach.call(document.forms, (form) => {
    if(!(form.attr("type") && form.attr("type") == "normal")) {
        
        form.els("input").forEach(me => me.on("change", function(e) {
            
            this.prnt().el(".error").innerText = "";
            
        }));
        form.addEventListener("submit", async function(e){
            
            e.preventDefault();
            
            let sButton = form.el("input[type='submit']");
            if(sButton !== null) {
                sButton.disabled = true;
            }
            let get = new URL(form.attr("action") !== null ? form.attr("action") : window.location.href, window.location);
            get.searchParams.set("loadPage", "no-headers");
            let fd = new FormData(form);
            
            await new Promise(function(res) {
                
                var files = 0;
                Array.from(fd).forEach(async function(item){
                    
                    if(item[1] instanceof File) {
                        
                        files++;
                        
                        let d = await uploadTempFile(item[1], form.el(`[inputName='${item[0]}'] > label`));
                        if(d.startsWith("error:"))
                            form.el(`[inputName='${item[0]}'] .error`).innerText = d.split("error:")[1];
                        fd.set(item[0], d);
                        
                        files--;
                        
                        if(files == 0)
                            res();
                        
                    }
                    
                    
                });
                
                if(files == 0)
                    res();
                
            });
            
            if(sButton !== null)
                sButton.addc("input_loading");
            
            
            fetch(get.href, {
                method: 'POST',
                cache: 'no-cache',
                redirect: 'follow',
                referrerPolicy: 'no-referrer',
                body: form.attr("enctype") == "multipart/form-data" ? fd : new URLSearchParams(fd) // body data type must match "Content-Type" header
            }).then(async function(e){
                let out;
                if(e.status == 200 || e.status == 400 || e.status == 401)
                    out = await e.json();
                
                if(sButton !== null) {
                    sButton.disabled = false;
                    sButton.remc("input_loading");
                }
                
                if(e.status == 200) {
                    let btns = JSON.parse(form.attr("success_buttons"));
                    btns.forEach(function(btn) {
                        
                        if(typeof btn[2] == "object")
                            btn[2] = btn[2].str.replace(btn[2].replace, out.output[btn[2].replaceWith]);
                        
                    });
                    
                    MODAL(form.attr("success_title"), form.attr('success_text'), btns);
                    
                    if(form.attr("options_clearonsubmit") == "1")
                        form.reset();
                    if(form.attr("options_hideonsubmit") == "1")
                        form.attr("visible", "false");
                    
                } else if(e.status == 400 || e.status == 401) {
                    
                    Object.entries(out.errors).forEach(function(e) {
                        
                        let errorEl;
                        if(e[0] == "genericError")
                            errorEl = form.el("[inputName='submit_button']");
                        else
                            errorEl = form.el(`[inputName='${e[0]}']`);
                        if(errorEl !== null) {
                            errorEl.el(".error").html("").txt(e[1]);
                            errorEl.addc("visibleError");
                        }
                    })
                    
                } else if(e.status == 524) {
                    
                    let errorEl = form.el("[inputName='submit_button'] .error");
                    
                    if(errorEl !== null) {
                        
                        errorEl.txt(l("error_processing_tooktoolong"));
                        errorEl.prnt().addc("visibleError");
                        
                    }
                    
                }
                
            });
            
            return false;
            
        });
        
    }
});

