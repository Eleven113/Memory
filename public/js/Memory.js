class Memory {
    constructor() {
        this.cards = document.getElementsByClassName("card_img");
        this.divplayer1Ico = document.getElementById("player_1_ico");
        this.divplayer1Ico.innerHTML = '<i class="fas fa-play"></i>';
        this.divModalWinner = document.getElementById("modal_winner");
        this.spanWinnerName = document.getElementById("winner_name");
        this.spanWinnerMatchedCards = document.getElementById("winner_matched-cards");
        this.spanWinnerTry = document.getElementById("winner_try");
        this.spanWinnerTime = document.getElementById("winner_time");
        this.spanTimer = document.getElementById("gameinfo_time-num");
        this.events();
        this.isRequesting = false ;
        this.currentPair = [];
    }

    events(){
        for ( let i=0; i < this.cards.length; i++){
            this.cards[i].addEventListener("click", function(event){
                this.checkCard(event);
            }.bind(this))
        }
    }

    checkCard(event){
        if ( !this.isRequesting ) {
            this.isRequesting = true;

            this.id = event.target.id.split('_')[1];
            $.get('/Memory/public/index.php/game/play/' + this.id, function (data) {
                document.getElementById("player_1_try-num").innerText = data.players[0].tryCount;
                if (data.players.length === 2) {
                    document.getElementById("player_2_try-num").innerText = data.players[1].tryCount;
                    this.playerId = parseInt(data.player) + 1;

                    if (this.playerId === 1) {
                        document.getElementById("player_1_ico").innerHTML = '<i class="fas fa-play"></i>';
                        document.getElementById("player_2_ico").innerHTML = '';
                    } else {
                        document.getElementById("player_2_ico").innerHTML = '<i class="fas fa-play"></i>';
                        document.getElementById("player_1_ico").innerHTML = '';
                    }
                }

                if (data.symbol !== null) {
                    this.currentPair.push(this.id);
                    this.img = document.getElementById('card_' + this.id);
                    this.img.src = '/Memory/public/img/' + data.theme + '/' + data.symbol + '.png';
                }

                if (data.isPairComplete === true && data.isMatching === false) {
                    setTimeout(() => {
                        document.getElementById('card_' + this.currentPair[0]).src = '/Memory/public/img/hidden.png';
                        document.getElementById('card_' + this.currentPair[1]).src = '/Memory/public/img/hidden.png';
                        this.currentPair = [];
                    }, 1000);
                }

                if (data.isMatching === true) {
                    this.currentPair = [];
                }

                if (data.isGameOver === true) {
                    new SetScore(data.winner.name, this.spanTimer.textContent, data.winner.tryCount, data.difficulty, data.players.length);

                    this.spanWinnerName.textContent = data.winner.name;
                    this.spanWinnerMatchedCards.textContent = data.winner.matchedCards.length;
                    this.spanWinnerTry.textContent = data.winner.tryCount;
                    this.spanWinnerTime.textContent = this.spanTimer.textContent;

                    this.divModalWinner.style.display = "flex";

                }

                this.isRequesting = false;
            }.bind(this));
        }
    }
}

let memory = new Memory();