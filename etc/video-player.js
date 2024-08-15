
function searchForPlayers() {
    
    let players = doc.els(".videobox > .player");
    
    players.forEach(function(player) {
        
        player.el("video").controls = false;
        
        player.el(".progressbar").on("mousedown", function(e){
            
            player.el("video").pause();
            
        });
        
    });
    
}

searchForPlayers();
