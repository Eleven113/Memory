class Memory {
    constructor() {
        this.cards = document.getElementsByClassName("card_img");
        this.divplayer1Ico = document.getElementById("player_1_ico");
        this.divplayer1Ico.innerHTML = '<i class="fas fa-play"></i>';
        this.events();
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
        this.id = event.target.id.split('_')[1];
        $.get('/Memory/mooc-symfony4/public/index.php/game/play/'+ this.id , function(data){

            this.playerId = parseInt(data.player) + 1;

            if ( this.playerId === 1) {
                document.getElementById("player_1_ico").innerHTML = '<i class="fas fa-play"></i>';
                document.getElementById("player_2_ico").innerHTML = '';
            } else {
                document.getElementById("player_2_ico").innerHTML = '<i class="fas fa-play"></i>';
                document.getElementById("player_1_ico").innerHTML = '';
            }

            if ( data.symbol !== null ){
                this.currentPair.push(this.id);
                this.img = document.getElementById('card_'+this.id);
                this.img.src = '/Memory/mooc-symfony4/public/img/' + data.theme + '/' + data.symbol + '.png';
            }

            if ( data.isPairComplete === true && data.isMatching === false ){
                setTimeout( () => {
                    document.getElementById('card_' + this.currentPair[0]).src = '/Memory/mooc-symfony4/public/img/hidden.png';
                    document.getElementById('card_' + this.currentPair[1]).src = '/Memory/mooc-symfony4/public/img/hidden.png';
                    this.currentPair = [];
                },1000);
            }

            if ( data.isMatching === true ) {
                this.currentPair = [];
            }

        }.bind(this));
    }
}

let memory = new Memory();