class Memory {
    constructor() {
        this.cards = document.getElementsByClassName("card_img");
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

        })
    }
}

let memory = new Memory();