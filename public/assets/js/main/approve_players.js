
(function(){
    const approve_btns = document.getElementsByClassName('approve-btn');

    const approve_player = function (btn) {
        const player_id = (btn.target.getAttribute('data-target-user'));
        btn.target.innerText = "Approving..."
    
        $.post("/action/approve_players",   {
            player_id: player_id
          }, function(data, status){
            console.log("Data: " + data + "\nStatus: " + status);
            btn.target.innerText = "Unapprove";
          });
    }

    approve_btns.forEach(approve_btn => {
        approve_btn.addEventListener('click', (e) => {
            approve_player(e);
        });
    });

})();