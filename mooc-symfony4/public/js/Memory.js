class Memory {
    constructor() {
        this.cards = document.getElementsByClassName("card_img");
        this.divplayer1Ico = document.getElementById("player_1_ico");
        this.divplayer1Ico.innerHTML = '<i class="fas fa-play"></i>';
        this.divplayer1Ico.style.color = '#007bff';
        this.events();
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
            console.log(data);
            console.log(data.symbol);
            this.img = document.getElementById('card_'+this.id);
            this.img.src = '/Memory/mooc-symfony4/public/img/' + data.theme + '/' + data.symbol + '.png';
        }.bind(this));
    }
}

let memory = new Memory();