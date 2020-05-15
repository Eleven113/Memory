class Memory {
    constructor() {
        this.cards = document.getElementsByClassName("card_img");
        console.log(this.cards);
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
        console.log(this.id);
        $.get('/Memory/mooc-symfony4/public/index.php/game/play/'+ this.id , function(data){
            console.log(data);
        })
    }
}

let memory = new Memory();