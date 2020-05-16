class HighscoreDisplay{
    constructor() {
        this.divEasy = document.getElementById("hs_difficulty-easy");
        this.divMedium = document.getElementById("hs_difficulty-medium");
        this.divHard = document.getElementById("hs_difficulty-hard");
        this.div1Player = document.getElementById("hs_numplayers-1");
        this.div2Players = document.getElementById("hs_numplayers-2");
        this.h4 = document.getElementById("caption");
        this.tbody = document.querySelector("tbody");
        this.numplayers = 1;
        this.difficulty = "easy";
        this.events();

    }

    events(){
        this.divEasy.addEventListener("click", function(event){
            this.difficulty = "easy";
            this.display(event);
        }.bind(this));

        this.divMedium.addEventListener("click", function(event){
            this.difficulty = "medium";
            this.display(event);
        }.bind(this));

        this.divHard.addEventListener("click", function(event){
            this.difficulty = "hard";
            this.display(event);
        }.bind(this));

        this.div1Player.addEventListener("click", function(event){
            this.numplayers = 1;
            this.display(event);
        }.bind(this));

        this.div2Players.addEventListener("click", function(event){
            this.numplayers = 2;
            this.display(event);
        }.bind(this));

    }

    display(event){
        let difficulties = {
            "easy": "Facile",
            "medium": "Moyen",
            "hard": "Difficile"
        };
        let numplayers = {
          1: "1 joueur",
          2: "2 joueurs"
        };
        this.h4.textContent = "Mode " + numplayers[this.numplayers] + " / " + difficulties[this.difficulty];
        this.divEasy.className = "col-4 text-center font-weight-bold";
        this.divMedium.className = "col-4 text-center";
        this.divHard.className = "col-4 text-center";
        this.getScore(this.difficulty, this.numplayers);
    }

    getScore($numcards,$numplayers){
        $.get('/Memory/mooc-symfony4/public/index.php/score/getscore/'+$numcards+'/'+$numplayers, function(data){
            document.querySelector("tbody").innerHTML = '';
            for (let i=0; i <= data.length; i++){
                this.tr = document.createElement('tr');
                this.tr.innerHTML = '<td>' + data[i].player + '</td><td>' + data[i].try + '</td><td>' + data[i].time + '</td>';
                document.querySelector("tbody").append(this.tr);
            }
        });
    }
}

let highscoreDisplay = new HighscoreDisplay();