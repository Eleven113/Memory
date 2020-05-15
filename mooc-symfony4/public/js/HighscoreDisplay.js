class HighscoreDisplay{
    constructor() {
        this.divEasy = document.getElementById("hs_difficulty-easy");
        this.divMedium = document.getElementById("hs_difficulty-medium");
        this.divHard = document.getElementById("hs_difficulty-hard");
        this.h4 = document.getElementById("caption");
        this.events();

    }

    events(){
        this.divEasy.addEventListener("click", function(event){
            this.display(event);
            console.log("click easy");
        }.bind(this));
        this.divMedium.addEventListener("click", function(event){
            this.display(event);
            console.log("click Medium");
        }.bind(this));
        this.divHard.addEventListener("click", function(event){
            this.display(event);
            console.log("click Hard");
        }.bind(this));

    }

    display(event){
        this.difficulty = event.target.id.split('-')[1];
        //
        // this.difficulty = this.difficulty.charAt(0).toUpperCase() + this.difficulty.slice(1);
        console.log(this.difficulty);


        switch (this.difficulty) {
            case "easy":
                this.h4.textContent = "Mode Facile";
                this.divEasy.className = "font-weight-bold";
                this.divMedium.className = "";
                this.divHard.className = "";
                break;

            case "medium":
                this.h4.textContent = "Mode Moyen";
                this.divEasy.className = "";
                this.divMedium.className = "font-weight-bold";
                this.divHard.className = "";
                break;

            case "hard":
                this.h4.textContent = "Mode Difficile";
                this.divEasy.className = "";
                this.divMedium.className = "";
                this.divHard.className = "font-weight-bold";
                break;

            default:
                break;
        }

    }
}

let highscoreDisplay = new HighscoreDisplay();